@extends('home/layouts/main')

@section('css')
    <style>
        .header {
            display: none;
        }

        .footer {
            display: none;
        }

        body {
            background-image: url('{{ asset('assets/images/backgrounds/login-bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
@endsection

@section('content')
<div class="login-page pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 h-100">
    <div class="container">
        <div class="form-box" style="width: 90% !important; max-width: 100% !important">
            @if(session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
            @if(session('message'))
                <div class="alert alert-success mt-4">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-tab">
                <div class="tab-content">
                    <div class="tab-pane fade active show">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="d-flex">
                                <div class="col-sm-6 pr-4">
                                    <div class="d-flex">
                                        <div class="col-6 pl-0">
                                            <div class="form-group">
                                                <label for="first_name">First name *</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" required="">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">                          
                                            <div class="form-group">
                                                <label for="last_name">Last name *</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="text" class="form-control" id="email" name="email" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone number *</label>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control" id="password" name="password" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm password *</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required="">
                                    </div>  
                                </div>
                                
                                <div class="col-sm-6 pl-4">
                                    <div class="d-flex">
                                        <div class="col-6 pl-0">
                                            <label for="country">Country *</label>
                                            <select name="country" class="form-control" id="country">
                                                <option label="Select a country ... " selected="selected">Select a country ... </option>
                                                <optgroup id="country-optgroup-Africa" label="Africa">
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo - Brazzaville">Congo - Brazzaville</option>
                                                    <option value="Congo - Kinshasa">Congo - Kinshasa</option>
                                                    <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Réunion">Réunion</option>
                                                    <option value="Saint Helena">Saint Helena</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </optgroup>
                                                <optgroup id="country-optgroup-Americas" label="Americas">
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Virgin Islands">British Virgin Islands</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Falkland Islands">Falkland Islands</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Saint Barthélemy">Saint Barthélemy</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Martin">Saint Martin</option>
                                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                    <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                                    <option value="United States">United States</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                </optgroup>
                                                <optgroup id="country-optgroup-Asia" label="Asia">
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="China">China</option>
                                                    <option value="Hong Kong SAR China">Hong Kong SAR China</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Macau SAR China">Macau SAR China</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Neutral Zone">Neutral Zone</option>
                                                    <option value="North Korea">North Korea</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palestinian Territories">Palestinian Territories</option>
                                                    <option value="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="South Korea">South Korea</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-Leste">Timor-Leste</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Yemen">Yemen</option>
                                                </optgroup>
                                                <optgroup id="country-optgroup-Europe" label="Europe">
                                                    <option value="Albania">Albania</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="East Germany">East Germany</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Metropolitan France">Metropolitan France</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Vatican City">Vatican City</option>
                                                    <option value="Åland Islands">Åland Islands</option>
                                                </optgroup>
                                                <optgroup id="country-optgroup-Oceania" label="Oceania">
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Antarctica">Antarctica</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Territories">French Southern Territories</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Micronesia">Micronesia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Pitcairn Islands">Pitcairn Islands</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-6 pr-0">                          
                                            <div class="form-group">
                                                <label for="city">City *</label>
                                                <input type="text" class="form-control" id="city" name="city" required="">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="primary_address">Primary address *</label>
                                        <input type="text" class="form-control" id="primary_address" name="primary_address" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="secondary_address">Secondary address</label>
                                        <input type="text" class="form-control" id="secondary_address" name="secondary_address">
                                    </div>

                                    <div class="form-group">
                                        <label for="zip_code">Zip code *</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" required="">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-footer mt-4">
                                <button type="submit" class="btn btn-outline-primary-2 w-100">
                                    <span>REGISTER</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                        <div class="form-choice">
                            <p class="text-center">If you already have account, let's <a href="{{ route('login') }}">sign in</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
