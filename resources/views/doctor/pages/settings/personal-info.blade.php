@extends('layouts.doctor')

@section('title', 'Personal Information Page')
@section('description', 'This is the Your Personal Information Page')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Personal Info Page
                    </li>
                </ol>
                    @include('notifications.status_message')
                    @include('notifications.errors_message')
            </div>

        </div>

    <div class="row col-md-12">
        <div class="well">
        <legend>Personal Information Edit Form</legend>
    <!--Starting the Avatar-Form--->

        <form action="{{url('doctor/settings/personal-info/save_avatar')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

         <!--Hidden User ID Field-->

                        <input type="hidden" id="userId" name="userId" value="{{ $personal_info->id }}">
                        <br />
        <!--Picture-->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <img class="col-md-4" src="{{url('public/assets/img/'.$personal_info->imageUrl)}}" alt="Profile Picture" style="width:200px; height:200px; border-radius:15%; margin:5px; padding-bottom: 2px;"/>
                        </div>
                        <div class="form-group row">
                            <label for="profilePicture" class="col-md-4 control-label">Avatar: </label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group" id="profilePicture">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                    <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/gif, image/jpeg, image/png"/>
                                </div>
                            </div>

                            <!--Submit Button-->
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Upload</button>
                                </div>
                        </div>

        <div class="col-md-4"></div>

                    {{ csrf_field() }}
        </form>




        <!--Starting the Info-Form--->

        <form action="{{url('doctor/settings/personal-info/save')}}" method="post" class="form-horizontal" role="form" style="padding-top: 1px;">


                    <fieldset>

        <!--Hidden User ID Field-->

                        <input type="hidden" id="userId" name="userId" value="{{ $personal_info->id }}">
                        <br />

        <!--Date of Birth-->
                        <div class="form-group row">
                            <label for="dateOfBirth" class="col-md-4 control-label">Date of Birth: </label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" maxlength="10" readonly value="{{ $personal_info->date_of_birth }}" />
                                </div>
                            </div>
                        </div>
        <!--Gender-->
                        <div class="form-group row">
                            <label for="countryName" class="col-md-4 control-label">Gender/Sex: </label>
                            <div class="col-md-4 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <select class="form-control selectpicker" id="genderName" name="genderName" disabled>
                                        <option value="" label="" selected="selected">Select Your Gender</option>
                                        <option value="0" label="" selected="selected">Male</option>
                                        <option value="1" label="" selected="selected">Female</option>
                                        <option value="2" label="" selected="selected">Transgender</option>
                                    </select>

        <!--JS script to select an item to reflect query data-->

                                    <script>document.getElementById('genderName').value = '{{ $personal_info->gender }}';</script>
                                </div>
                            </div>
                        </div>
        <!--Home Town-->
                        <div class="form-group row">
                            <label for="homeTown" class="col-md-4 control-label">Home Town: </label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input type="text" class="form-control" name="homeTown" id="homeTown" maxlength="50" readonly value="{{ $personal_info->home_town }}" placeholder="Type Your Home Towm Name Here.." />
                                </div>
                            </div>
                        </div>
        <!--Country-->
                        <div class="form-group row">
                            <label for="countryName" class="col-md-4 control-label">Country: </label>
                            <div class="col-md-4 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                    <select class="form-control selectpicker" id="countryName" name="countryName" disabled>
                                        <option value="" label="" selected="selected">Select your Country..</option>
                                        <optgroup id="country-optgroup-Africa" label="Africa">
                                            <option value="DZ" label="Algeria">Algeria</option>
                                            <option value="AO" label="Angola">Angola</option>
                                            <option value="BJ" label="Benin">Benin</option>
                                            <option value="BW" label="Botswana">Botswana</option>
                                            <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                            <option value="BI" label="Burundi">Burundi</option>
                                            <option value="CM" label="Cameroon">Cameroon</option>
                                            <option value="CV" label="Cape Verde">Cape Verde</option>
                                            <option value="CF" label="Central African Republic">Central African Republic</option>
                                            <option value="TD" label="Chad">Chad</option>
                                            <option value="KM" label="Comoros">Comoros</option>
                                            <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                                            <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                            <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                            <option value="DJ" label="Djibouti">Djibouti</option>
                                            <option value="EG" label="Egypt">Egypt</option>
                                            <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="ER" label="Eritrea">Eritrea</option>
                                            <option value="ET" label="Ethiopia">Ethiopia</option>
                                            <option value="GA" label="Gabon">Gabon</option>
                                            <option value="GM" label="Gambia">Gambia</option>
                                            <option value="GH" label="Ghana">Ghana</option>
                                            <option value="GN" label="Guinea">Guinea</option>
                                            <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="KE" label="Kenya">Kenya</option>
                                            <option value="LS" label="Lesotho">Lesotho</option>
                                            <option value="LR" label="Liberia">Liberia</option>
                                            <option value="LY" label="Libya">Libya</option>
                                            <option value="MG" label="Madagascar">Madagascar</option>
                                            <option value="MW" label="Malawi">Malawi</option>
                                            <option value="ML" label="Mali">Mali</option>
                                            <option value="MR" label="Mauritania">Mauritania</option>
                                            <option value="MU" label="Mauritius">Mauritius</option>
                                            <option value="YT" label="Mayotte">Mayotte</option>
                                            <option value="MA" label="Morocco">Morocco</option>
                                            <option value="MZ" label="Mozambique">Mozambique</option>
                                            <option value="NA" label="Namibia">Namibia</option>
                                            <option value="NE" label="Niger">Niger</option>
                                            <option value="NG" label="Nigeria">Nigeria</option>
                                            <option value="RW" label="Rwanda">Rwanda</option>
                                            <option value="RE" label="Réunion">Réunion</option>
                                            <option value="SH" label="Saint Helena">Saint Helena</option>
                                            <option value="SN" label="Senegal">Senegal</option>
                                            <option value="SC" label="Seychelles">Seychelles</option>
                                            <option value="SL" label="Sierra Leone">Sierra Leone</option>
                                            <option value="SO" label="Somalia">Somalia</option>
                                            <option value="ZA" label="South Africa">South Africa</option>
                                            <option value="SD" label="Sudan">Sudan</option>
                                            <option value="SZ" label="Swaziland">Swaziland</option>
                                            <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                            <option value="TZ" label="Tanzania">Tanzania</option>
                                            <option value="TG" label="Togo">Togo</option>
                                            <option value="TN" label="Tunisia">Tunisia</option>
                                            <option value="UG" label="Uganda">Uganda</option>
                                            <option value="EH" label="Western Sahara">Western Sahara</option>
                                            <option value="ZM" label="Zambia">Zambia</option>
                                            <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                        </optgroup>
                                        <optgroup id="country-optgroup-Americas" label="Americas">
                                            <option value="AI" label="Anguilla">Anguilla</option>
                                            <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="AR" label="Argentina">Argentina</option>
                                            <option value="AW" label="Aruba">Aruba</option>
                                            <option value="BS" label="Bahamas">Bahamas</option>
                                            <option value="BB" label="Barbados">Barbados</option>
                                            <option value="BZ" label="Belize">Belize</option>
                                            <option value="BM" label="Bermuda">Bermuda</option>
                                            <option value="BO" label="Bolivia">Bolivia</option>
                                            <option value="BR" label="Brazil">Brazil</option>
                                            <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                            <option value="CA" label="Canada">Canada</option>
                                            <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                            <option value="CL" label="Chile">Chile</option>
                                            <option value="CO" label="Colombia">Colombia</option>
                                            <option value="CR" label="Costa Rica">Costa Rica</option>
                                            <option value="CU" label="Cuba">Cuba</option>
                                            <option value="DM" label="Dominica">Dominica</option>
                                            <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                            <option value="EC" label="Ecuador">Ecuador</option>
                                            <option value="SV" label="El Salvador">El Salvador</option>
                                            <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                            <option value="GF" label="French Guiana">French Guiana</option>
                                            <option value="GL" label="Greenland">Greenland</option>
                                            <option value="GD" label="Grenada">Grenada</option>
                                            <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                            <option value="GT" label="Guatemala">Guatemala</option>
                                            <option value="GY" label="Guyana">Guyana</option>
                                            <option value="HT" label="Haiti">Haiti</option>
                                            <option value="HN" label="Honduras">Honduras</option>
                                            <option value="JM" label="Jamaica">Jamaica</option>
                                            <option value="MQ" label="Martinique">Martinique</option>
                                            <option value="MX" label="Mexico">Mexico</option>
                                            <option value="MS" label="Montserrat">Montserrat</option>
                                            <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="NI" label="Nicaragua">Nicaragua</option>
                                            <option value="PA" label="Panama">Panama</option>
                                            <option value="PY" label="Paraguay">Paraguay</option>
                                            <option value="PE" label="Peru">Peru</option>
                                            <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                            <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                            <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                            <option value="MF" label="Saint Martin">Saint Martin</option>
                                            <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="SR" label="Suriname">Suriname</option>
                                            <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="US" label="United States">United States</option>
                                            <option value="UY" label="Uruguay">Uruguay</option>
                                            <option value="VE" label="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup id="country-optgroup-Asia" label="Asia">
                                            <option value="AF" label="Afghanistan">Afghanistan</option>
                                            <option value="AM" label="Armenia">Armenia</option>
                                            <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                            <option value="BH" label="Bahrain">Bahrain</option>
                                            <option value="BD" label="Bangladesh">Bangladesh</option>
                                            <option value="BT" label="Bhutan">Bhutan</option>
                                            <option value="BN" label="Brunei">Brunei</option>
                                            <option value="KH" label="Cambodia">Cambodia</option>
                                            <option value="CN" label="China">China</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="GE" label="Georgia">Georgia</option>
                                            <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                            <option value="IN" label="India">India</option>
                                            <option value="ID" label="Indonesia">Indonesia</option>
                                            <option value="IR" label="Iran">Iran</option>
                                            <option value="IQ" label="Iraq">Iraq</option>
                                            <option value="IL" label="Israel">Israel</option>
                                            <option value="JP" label="Japan">Japan</option>
                                            <option value="JO" label="Jordan">Jordan</option>
                                            <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                            <option value="KW" label="Kuwait">Kuwait</option>
                                            <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="LA" label="Laos">Laos</option>
                                            <option value="LB" label="Lebanon">Lebanon</option>
                                            <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                            <option value="MY" label="Malaysia">Malaysia</option>
                                            <option value="MV" label="Maldives">Maldives</option>
                                            <option value="MN" label="Mongolia">Mongolia</option>
                                            <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="NP" label="Nepal">Nepal</option>
                                            <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                            <option value="KP" label="North Korea">North Korea</option>
                                            <option value="OM" label="Oman">Oman</option>
                                            <option value="PK" label="Pakistan">Pakistan</option>
                                            <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                            <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                            <option value="PH" label="Philippines">Philippines</option>
                                            <option value="QA" label="Qatar">Qatar</option>
                                            <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                            <option value="SG" label="Singapore">Singapore</option>
                                            <option value="KR" label="South Korea">South Korea</option>
                                            <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                            <option value="SY" label="Syria">Syria</option>
                                            <option value="TW" label="Taiwan">Taiwan</option>
                                            <option value="TJ" label="Tajikistan">Tajikistan</option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                            <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                            <option value="TR" label="Turkey">Turkey</option>
                                            <option value="™" label="Turkmenistan">Turkmenistan</option>
                                            <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                            <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                            <option value="VN" label="Vietnam">Vietnam</option>
                                            <option value="YE" label="Yemen">Yemen</option>
                                        </optgroup>
                                        <optgroup id="country-optgroup-Europe" label="Europe">
                                            <option value="AL" label="Albania">Albania</option>
                                            <option value="AD" label="Andorra">Andorra</option>
                                            <option value="AT" label="Austria">Austria</option>
                                            <option value="BY" label="Belarus">Belarus</option>
                                            <option value="BE" label="Belgium">Belgium</option>
                                            <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="BG" label="Bulgaria">Bulgaria</option>
                                            <option value="HR" label="Croatia">Croatia</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="CZ" label="Czech Republic">Czech Republic</option>
                                            <option value="DK" label="Denmark">Denmark</option>
                                            <option value="EE" label="Estonia">Estonia</option>
                                            <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                            <option value="FI" label="Finland">Finland</option>
                                            <option value="FR" label="France">France</option>
                                            <option value="DE" label="Germany">Germany</option>
                                            <option value="GI" label="Gibraltar">Gibraltar</option>
                                            <option value="GR" label="Greece">Greece</option>
                                            <option value="GG" label="Guernsey">Guernsey</option>
                                            <option value="HU" label="Hungary">Hungary</option>
                                            <option value="IS" label="Iceland">Iceland</option>
                                            <option value="IE" label="Ireland">Ireland</option>
                                            <option value="IM" label="Isle of Man">Isle of Man</option>
                                            <option value="IT" label="Italy">Italy</option>
                                            <option value="JE" label="Jersey">Jersey</option>
                                            <option value="LV" label="Latvia">Latvia</option>
                                            <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                            <option value="LT" label="Lithuania">Lithuania</option>
                                            <option value="LU" label="Luxembourg">Luxembourg</option>
                                            <option value="MK" label="Macedonia">Macedonia</option>
                                            <option value="MT" label="Malta">Malta</option>
                                            <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                            <option value="MD" label="Moldova">Moldova</option>
                                            <option value="MC" label="Monaco">Monaco</option>
                                            <option value="ME" label="Montenegro">Montenegro</option>
                                            <option value="NL" label="Netherlands">Netherlands</option>
                                            <option value="NO" label="Norway">Norway</option>
                                            <option value="PL" label="Poland">Poland</option>
                                            <option value="PT" label="Portugal">Portugal</option>
                                            <option value="RO" label="Romania">Romania</option>
                                            <option value="RU" label="Russia">Russia</option>
                                            <option value="SM" label="San Marino">San Marino</option>
                                            <option value="RS" label="Serbia">Serbia</option>
                                            <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="SK" label="Slovakia">Slovakia</option>
                                            <option value="SI" label="Slovenia">Slovenia</option>
                                            <option value="ES" label="Spain">Spain</option>
                                            <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="SE" label="Sweden">Sweden</option>
                                            <option value="CH" label="Switzerland">Switzerland</option>
                                            <option value="UA" label="Ukraine">Ukraine</option>
                                            <option value="GB" label="United Kingdom">United Kingdom</option>
                                            <option value="VA" label="Vatican City">Vatican City</option>
                                            <option value="AX" label="Åland Islands">Åland Islands</option>
                                        </optgroup>
                                        <optgroup id="country-optgroup-Oceania" label="Oceania">
                                            <option value="AS" label="American Samoa">American Samoa</option>
                                            <option value="AQ" label="Antarctica">Antarctica</option>
                                            <option value="AU" label="Australia">Australia</option>
                                            <option value="BV" label="Bouvet Island">Bouvet Island</option>
                                            <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="CX" label="Christmas Island">Christmas Island</option>
                                            <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                            <option value="CK" label="Cook Islands">Cook Islands</option>
                                            <option value="FJ" label="Fiji">Fiji</option>
                                            <option value="PF" label="French Polynesia">French Polynesia</option>
                                            <option value="TF" label="French Southern Territories">French Southern Territories</option>
                                            <option value="GU" label="Guam">Guam</option>
                                            <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                            <option value="KI" label="Kiribati">Kiribati</option>
                                            <option value="MH" label="Marshall Islands">Marshall Islands</option>
                                            <option value="FM" label="Micronesia">Micronesia</option>
                                            <option value="NR" label="Nauru">Nauru</option>
                                            <option value="NC" label="New Caledonia">New Caledonia</option>
                                            <option value="NZ" label="New Zealand">New Zealand</option>
                                            <option value="NU" label="Niue">Niue</option>
                                            <option value="NF" label="Norfolk Island">Norfolk Island</option>
                                            <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="PW" label="Palau">Palau</option>
                                            <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                            <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                            <option value="WS" label="Samoa">Samoa</option>
                                            <option value="SB" label="Solomon Islands">Solomon Islands</option>
                                            <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                            <option value="TK" label="Tokelau">Tokelau</option>
                                            <option value="TO" label="Tonga">Tonga</option>
                                            <option value="TV" label="Tuvalu">Tuvalu</option>
                                            <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                            <option value="VU" label="Vanuatu">Vanuatu</option>
                                            <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                                        </optgroup>
                                    </select>

        <!--Script to select a country option from the Select drop down menu getting value from database.-->

                                    <script>document.getElementById('countryName').value = '{{ $personal_info->country }}';</script>

                                </div>
                            </div>
                        </div>

        <!--Address-->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 control-label">Address: </label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <textarea class="form-control" id="address" name="address" readonly placeholder="Type Your Address Here.." maxlength="255">{{ $personal_info->address }}</textarea>
                                </div>
                            </div>
                        </div>
                                <br />


        <!--Submit Button-->
                        <div class="form-group row" id="showBTN_saveCancel" hidden>
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-2" style="margin: 3px; padding: 3px;">
                                <button type="submit" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                            </div>
                            <div class="col-sm-2" style="margin: 3px; padding: 3px;">
                                <a href="/doctor/settings/personal-info"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
                            </div>
                        </div>
        <div class="col-md-4"></div>

        <!--Edit Button-->
            <button type="button" class="btn btn-lg btn-warning col-md-4" id="btnEdit" onclick="enableFields()"> <span class="glyphicon glyphicon-edit"> Edit </span></button>
                    </fieldset>
                    {{ csrf_field() }}
        </form>
        </div>
    </div>
</div>
@endsection

@section('jscript')
<!--Custom Java Script-->
<script>

//this JS function enables the form fields for editing

    function enableFields(){
        document.getElementById("showBTN_saveCancel").style.display = "block";
        document.getElementById("btnEdit").style.display = "none";

//Change Disabled Fileds to enabled
        document.getElementById("dateOfBirth").readOnly = false;
        document.getElementById("homeTown").readOnly = false;
        document.getElementById("address").readOnly = false;
        document.getElementById("countryName").disabled = false;
        document.getElementById("genderName").disabled = false;

    }


</script>
@endsection
