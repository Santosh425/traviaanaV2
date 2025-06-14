<div class="form-checkout" id="form-checkout">
    <input type="hidden" name="code" value="{{ $booking->code }}">
    <div class="form-section">
        <div class="row x-gap-20 y-gap-20 pt-20">

            @if (is_enable_guest_checkout() && is_enable_registration())
                <div class="col-12">
                    <div class="">
                        <label for="confirmRegister" class="flex ">
                            <input style="width: auto" type="checkbox" name="confirmRegister" id="confirmRegister"
                                value="1">
                            {{ __('Create a new account?') }}
                        </label>
                    </div>
                </div>
            @endif
            @if (is_enable_guest_checkout())
                <div class="col-12 d-none" id="confirmRegisterContent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-input ">
                                <input type="password" class="form-control" name="password" autocomplete="off">
                                <label class="lh-1 text-16 text-light-1">{{ __('Password') }} <span
                                        class="required">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-input ">
                                <input type="password" class="form-control" name="password_confirmation"
                                    autocomplete="off">
                                <label class="lh-1 text-16 text-light-1">{{ __('Password confirmation') }} <span
                                        class="required">*</span></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            @endif
            {{-- gender --}}
            <div class="col-md-6 field-country">
                <div class="form-input">
                    <select name="gender" class="form-control" required>
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="Male">{{ __('Male') }}</option>
                        <option value="Female">{{ __('Female') }}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </select>
                    <label class="lh-1 text-16 text-light-1">
                        {{ __('Gender') }} <span class="required">*</span>
                    </label>
                </div>
            </div>
            {{-- ager group  --}}
            <div class="col-md-6 field-country">
                <div class="form-input">
                    <select name="age_group" class="form-control" required>
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="Adult">{{ __('Adult') }}</option>
                        <option value="Kid">{{ __('Kid') }}</option>
                    </select>
                    <label class="lh-1 text-16 text-light-1">
                        {{ __('Age Group') }} <span class="required">*</span>
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->first_name ?? '' }}" name="first_name">
                    <label class="lh-1 text-16 text-light-1">{{ __('First Name') }} <span
                            class="required">*</span></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->last_name ?? '' }}" name="last_name">
                    <label class="lh-1 text-16 text-light-1">{{ __('Last Name') }} <span
                            class="required">*</span></label>
                </div>
            </div>
            <div class="col-md-6 field-email">
                <div class="form-input ">
                    <input type="email" class="form-control" value="{{ $user->email ?? '' }}" name="email">
                    <label class="lh-1 text-16 text-light-1">{{ __('Email') }} <span
                            class="required">*</span></label>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->phone ?? '' }}" name="phone">
                    <label class="lh-1 text-16 text-light-1">{{ __('Phone') }} <span
                            class="required">*</span></label>

                </div>
            </div>
            <div class="col-md-6 field-address-line-1">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->address ?? '' }}"
                        name="address_line_1">
                    <label class="lh-1 text-16 text-light-1">{{ __('Address line 1') }} </label>

                </div>
            </div>
            <div class="col-md-6 field-address-line-2">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->address2 ?? '' }}"
                        name="address_line_2">
                    <label class="lh-1 text-16 text-light-1">{{ __('Address line 2') }} </label>

                </div>
            </div>
            <div class="col-md-6 field-city">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->city ?? '' }}" name="city">
                    <label class="lh-1 text-16 text-light-1">{{ __('City') }} </label>

                </div>
            </div>
            <div class="col-md-6 field-state">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->state ?? '' }}" name="state">
                    <label class="lh-1 text-16 text-light-1">{{ __('State/Province/Region') }} </label>

                </div>
            </div>
            <div class="col-md-6 field-zip-code">
                <div class="form-input ">
                    <input type="text" class="form-control" value="{{ $user->zip_code ?? '' }}" name="zip_code">
                    <label class="lh-1 text-16 text-light-1">{{ __('ZIP code/Postal code') }} </label>
                </div>
            </div>
            <div class="col-md-6 field-country">
                <div class="form-input ">
                    <select name="country" class="form-control">
                        <option value="">{{ __('-- Select --') }}</option>
                        @foreach (get_country_lists() as $id => $name)
                            <option @if (($user->country ?? '') == $id) selected @endif value="{{ $id }}">
                                {{ $name }}</option>
                        @endforeach
                    </select>
                    <label class="lh-1 text-16 text-light-1">{{ __('Country') }} <span class="required">*</span>
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-input">
                    <textarea name="customer_notes" cols="30" rows="6" class="form-control"></textarea>
                    <label class="lh-1 text-16 text-light-1">{{ __('Special Requirements') }} </label>
                </div>
            </div>
        </div>
    </div>
    @if (($booking->total_guests ?? 1) > 1)
        <div class="col-12 mt-30">

            <div id="extraCustomersWrapper"></div>
        </div>
    @endif

    @include ('Booking::frontend/booking/checkout-passengers')
    @include ('Booking::frontend/booking/checkout-deposit')
    @include ($service->checkout_form_payment_file ?? 'Booking::frontend/booking/checkout-payment')

    @php
        $term_conditions = setting_item('booking_term_conditions');
    @endphp
    @if (setting_item('booking_enable_recaptcha'))
        <div class="form-input ">
            {{ recaptcha_field('booking') }}
        </div>
    @endif
    <div class="html_before_actions"></div>

    <p class="alert-text mt10" v-show=" message.content" v-html="message.content"
        :class="{ 'danger': !message.type, 'success': message.type }"></p>

    <div class="row y-gap-20 items-center justify-between mb-40">
        <div class="col-auto">
            <div class="d-flex items-center">
                <div class="form-checkbox ">
                    <input type="checkbox" name="term_conditions">
                    <div class="form-checkbox__mark">
                        <div class="form-checkbox__icon icon-check"></div>
                    </div>
                </div>
                <div class="text-14 lh-10 text-light-1 ml-10">{{ __('I have read and accept the') }} <a
                        target="_blank"
                        href="https://traviaana.com/page/terms-of-service-1">{{ __('terms and conditions') }}</a></div>

            </div>
        </div>

        <div class="col-auto">
            <button class="button h-60 px-24 -dark-1 bg-blue-1 text-white" @click="doCheckout">
                {{ __('Book Now') }}
                <div class="icon-arrow-top-right ml-15"></div>
                <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
            </button>

        </div>
    </div>

    <script>
        const customerCount = {{ $booking->total_guests ?? 1 }};
    </script>

    <script>
        let customerIndex = 0;

        function getExtraCustomerHtml(index) {
            return `


        <div class="extra-customer-section border p-20 rounded mb-20" data-index="${index}">
            <div class="d-flex justify-content-between align-items-center mb-10">
                <strong>{{ __('Traveller') }} ${index + 2}</strong>
            </div>
            <div class="row y-gap-20">

               <div class="col-md-6 field-country">
                <div class="form-input">
                    <select name="extra_customers[${index}][gender]" class="form-control" required>
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="Male">{{ __('Male') }}</option>
                        <option value="Female">{{ __('Female') }}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </select>
                    <label class="lh-1 text-16 text-light-1">
                        {{ __('Gender') }} <span class="required">*</span>
                    </label>
                </div>
               </div>

               <div class="col-md-6 field-country">
                <div class="form-input">
                    <select name="extra_customers[${index}][age_group]" class="form-control" required>
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="Adult">{{ __('Adult') }}</option>
                        <option value="Kid">{{ __('Kid') }}</option>
          
                    </select>
                    <label class="lh-1 text-16 text-light-1">
                        {{ __('Age Group') }} <span class="required">*</span>
                    </label>
                </div>
               </div>


                <div class="col-md-6">
                    <div class="form-input">
                        <input type="text" name="extra_customers[${index}][first_name]" class="form-control"  />
                        <label class="lh-1 text-16 text-light-1">{{ __('First Name') }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <input type="text" name="extra_customers[${index}][last_name]" class="form-control" />
                        <label class="lh-1 text-16 text-light-1">{{ __('Last Name') }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <input type="email" name="extra_customers[${index}][email]" class="form-control" />
                        <label class="lh-1 text-16 text-light-1">{{ __('Email') }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <input type="text" name="extra_customers[${index}][phone]" class="form-control" />
                        <label class="lh-1 text-16 text-light-1">{{ __('Phone') }}</label>
                    </div>
                </div>
            </div>
        </div>`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('extraCustomersWrapper');
            const extraCustomerCount = Math.max(0, customerCount - 1); // Only extra customers

            for (let i = 0; i < extraCustomerCount; i++) {
                wrapper.insertAdjacentHTML('beforeend', getExtraCustomerHtml(customerIndex));
                customerIndex++;
            }
        });
    </script>

</div>
