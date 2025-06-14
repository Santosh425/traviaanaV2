<?php
namespace Modules\Flight\Controllers;

use App\Notifications\AdminChannelServices;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Location\Models\LocationCategory;
use Modules\Flight\Models\Flight;
use Modules\Location\Models\Location;
use Modules\Core\Models\Attributes;
use Modules\Booking\Models\Booking;
use Modules\Flight\Models\FlightTerm;
use Modules\User\Models\Plan;

class ManageFlightController extends FrontendController
{
    protected $flightClass;
    protected $flightTermClass;
    protected $attributesClass;
    protected $locationClass;
    protected $bookingClass;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        parent::__construct();
        $this->flightClass = Flight::class;
        $this->flightTermClass = FlightTerm::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
        $this->bookingClass = Booking::class;
    }
    public function callAction($method, $parameters)
    {
        if(!Flight::isEnable())
        {
            return redirect('/');
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }

    public function manageFlight(Request $request)
    {
        $this->checkPermission('flight_view');
        $user_id = Auth::id();
        $rows = $this->flightClass::where("author_id", $user_id)->orderBy('id', 'desc')->with(['airline','airportTo','airportFrom','author']);
        $data = [
            'rows' => $rows->paginate(5),
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Flights'),
                    'url'  => route('flight.vendor.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Manage Flights"),
        ];
        return view('Flight::frontend.manageFlight.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('flight_view');
        $user_id = Auth::id();
        $rows = $this->flightClass::onlyTrashed()->where("author_id", $user_id)->orderBy('id', 'desc');
        $data = [
            'rows' => $rows->paginate(5),
            'recovery'           => 1,
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Flights'),
                    'url'  => route('flight.vendor.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Recovery Flights"),
        ];
        return view('Flight::frontend.manageFlight.index', $data);
    }

    public function restore($id)
    {
        $this->checkPermission('flight_delete');
        $user_id = Auth::id();
        $query = $this->flightClass::onlyTrashed()->where("author_id", $user_id)->where("id", $id)->first();
        if(!empty($query)){
            $query->restore();
            event(new UpdatedServiceEvent($query));

        }
        return redirect(route('flight.vendor.recovery'))->with('success', __('Restore flight success!'));
    }

    public function createFlight(Request $request)
    {
        $this->checkPermission('flight_create');
        $row = new $this->flightClass();
        $data = [
            'row'           => $row,
            'translation' => $row,
            'flight_location' => $this->locationClass::where("status","publish")->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where('status', 'publish')->get(),
            'attributes'    => $this->attributesClass::where('service', 'flight')->get(),
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Flights'),
                    'url'  => route('flight.vendor.index')
                ],
                [
                    'name'  => __('Create'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Create Flights"),
        ];
        return view('Flight::frontend.manageFlight.detail', $data);
    }


    public function store( Request $request, $id ){

        if($id>0){
            $this->checkPermission('flight_update');
            $row = $this->flightClass::find($id);
            if (empty($row)) {
                return redirect(route('flight.vendor.index'));
            }

            if($row->author_id != Auth::id() and !$this->hasPermission('flight_manage_others'))
            {
                return redirect(route('flight.vendor.index'));
            }
        }else{
            $this->checkPermission('flight_create');
            $row = new $this->flightClass();
            $row->status = "publish";
            if(setting_item("flight_vendor_create_service_must_approved_by_admin", 0)){
                $row->status = "pending";
            }
            $row->author_id = Auth::id();
        }

        $validator = Validator::make($request->all(), [
            'departure_time'=>'required',
            'arrival_time'=>'required',
            'duration'=>'required',
            'airport_from'=>'required',
            'airport_to'=>'required',
            'airline_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }
        $dataKeys = [
            'title',
            'code',
            'pnr',
            'departure_time',
            'arrival_time',
            'duration',
            'airport_from',
            'airport_to',
            'airline_id',
            'status',
        ];

        $row->fillByAttr($dataKeys,$request->input());

        if(!auth()->user()->checkUserPlan() and $row->status == "publish") {
            return redirect(route('user.plan'));
        }

        $res = $row->save();

        if ($res) {
            if(!$request->input('lang') or is_default_lang($request->input('lang'))) {
                $this->saveTerms($row, $request);
            }

            if($id > 0 ){
                event(new UpdatedServiceEvent($row));
                return back()->with('success',  __('Flight updated') );
            }else{
                event(new CreatedServicesEvent($row));
                return redirect(route('flight.vendor.edit',['id'=>$row->id]))->with('success', __('Flight created') );
            }
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->flightTermClass::where('target_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->flightTermClass::firstOrCreate([
                    'term_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->flightTermClass::where('target_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function editFlight(Request $request, $id)
    {
        $this->checkPermission('flight_update');
        $user_id = Auth::id();
        $row = $this->flightClass::where("author_id", $user_id);
        $row = $row->find($id);
        if (empty($row)) {
            return redirect(route('flight.vendor.index'))->with('warning', __('Flight not found!'));
        }
        $data = [
            'translation'    => $row,
            'row'           => $row,
            'attributes'    => $this->attributesClass::where('service', 'flight')->get(),
            "selected_terms" => $row->terms->pluck('term_id'),
            'breadcrumbs'        => [
                [
                    'name' => __('Manage Flights'),
                    'url'  => route('flight.vendor.index')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ],
            'page_title'         => __("Edit Flights"),
        ];
        return view('Flight::frontend.manageFlight.detail', $data);
    }

    public function deleteFlight($id)
    {
        $this->checkPermission('flight_delete');
        $user_id = Auth::id();
        if(\request()->query('permanently_delete')){
            $query = $this->flightClass::where("author_id", $user_id)->where("id", $id)->withTrashed()->first();
            if (!empty($query)) {
                $query->forceDelete();
            }
        }else {
            $query = $this->flightClass::where("author_id", $user_id)->where("id", $id)->first();
            if (!empty($query)) {
                $query->delete();
                event(new UpdatedServiceEvent($query));
            }
        }
        return redirect(route('flight.vendor.index'))->with('success', __('Delete flight success!'));
    }

    public function bulkEditFlight($id , Request $request){
        $this->checkPermission('flight_update');
        $action = $request->input('action');
        $user_id = Auth::id();
        $query = $this->flightClass::where("author_id", $user_id)->where("id", $id)->first();
        if (empty($id)) {
            return redirect()->back()->with('error', __('No item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if(empty($query)){
            return redirect()->back()->with('error', __('Not Found'));
        }
        switch ($action){
            case "make-hide":
                $query->status = "draft";
                break;
            case "make-publish":
                $query->status = "publish";
                if(!auth()->user()->checkUserPlan()) {
                    return redirect(route('user.plan'));
                }
                break;
        }
        $query->save();
        event(new UpdatedServiceEvent($query));

        return redirect()->back()->with('success', __('Update success!'));
    }

    public function bookingReportBulkEdit($booking_id , Request $request){
        $status = $request->input('status');
        if (!empty(setting_item("flight_allow_vendor_can_change_their_booking_status")) and !empty($status) and !empty($booking_id)) {
            $query = $this->bookingClass::where("id", $booking_id);
            $query->where("vendor_id", Auth::id());
            $item = $query->first();
            if(!empty($item)){
                $item->status = $status;
                $item->save();

                if($status == Booking::CANCELLED) $item->tryRefundToWallet();

                event(new BookingUpdatedEvent($item));
                return redirect()->back()->with('success', __('Update success'));
            }
            return redirect()->back()->with('error', __('Booking not found!'));
        }
        return redirect()->back()->with('error', __('Update fail!'));
    }

	public function cloneFlight(Request $request,$id){
		$this->checkPermission('flight_update');
		$user_id = Auth::id();
		$row = $this->flightClass::where("author_id", $user_id);
		$row = $row->find($id);
		if (empty($row)) {
			return redirect(route('flight.vendor.index'))->with('warning', __('Flight not found!'));
		}
		try{
			$clone = $row->replicate();
			$clone->status  = 'draft';
			$clone->push();
			if(!empty($row->terms)){
				foreach ($row->terms as $term){
					$e= $term->replicate();
					if($e->push()){
						$clone->terms()->save($e);

					}
				}
			}
			if(!empty($row->meta)){
				$e= $row->meta->replicate();
				if($e->push()){
					$clone->meta()->save($e);

				}
			}
			if(!empty($row->translations)){
				foreach ($row->translations as $translation){
					$e = $translation->replicate();
					$e->origin_id = $clone->id;
					if($e->push()){
						$clone->translations()->save($e);
					}
				}
			}

			return redirect()->back()->with('success',__('Flight clone was successful'));
		}catch (\Exception $exception){
			$clone->delete();
			return redirect()->back()->with('warning',__($exception->getMessage()));
		}
	}
}
