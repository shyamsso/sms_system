@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
      <div class="w-100 d-flex justify-content-center">
        <img src="{{asset('assets/img/illustrations/girl-with-laptop-'.$configData['style'].'.png')}}" class="img-fluid" alt="Login image" width="700" data-app-dark-img="illustrations/girl-with-laptop-dark.png" data-app-light-img="illustrations/girl-with-laptop-light.png">

      </div>
    </div>
    <!-- /Left Text -->

    <!-- Register -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
            <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Get started for free  🚀</h4>
        <p class="mb-4">Enjoy the benefits of our platform by signing up for free!</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" placeholder="johndoe" autofocus value="{{ old('name') }}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" />
            @error('email')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge @error('password') is-invalid @enderror">
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password-confirm">Confirm Password</label>
            <div class="input-group input-group-merge">
              <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>
          <div class="mb-3 fv-plugins-icon-container">
            <label class="form-label" for="country_code">country code</label>
            <select id="country_code" name="country_code" class="form-select">
              <option value="">Select</option>
              <option value="93">93(Afghanistan)</option>
              <option value="355">355(Albania)</option>
              <option value="213">213(Algeria)</option>
              <option value="1684">1684(American Samoa)</option>
              <option value="376">376(Andorra)</option>
              <option value="244">244(Angola)</option>
              <option value="1264">1264(Anguilla)</option>
              <option value="0">0(Antarctica)</option>
              <option value="1268">1268(Antigua and Barbuda)</option>
              <option value="54">54(Argentina)</option>
              <option value="374">374(Armenia)</option>
              <option value="297">297(Aruba)</option>
              <option value="61">61(Australia)</option>
              <option value="43">43(Austria)</option>
              <option value="994">994(Azerbaijan)</option>
              <option value="1242">1242(Bahamas)</option>
              <option value="973">973(Bahrain)</option>
              <option value="880">880(Bangladesh)</option>
              <option value="1246">1246(Barbados)</option>
              <option value="375">375(Belarus)</option>
              <option value="32">32(Belgium)</option>
              <option value="501">501(Belize)</option>
              <option value="229">229(Benin)</option>
              <option value="1441">1441(Bermuda)</option>
              <option value="975">975(Bhutan)</option>
              <option value="591">591(Bolivia)</option>
              <option value="387">387(Bosnia and Herzegovina)</option>
              <option value="267">267(Botswana)</option>
              <option value="0">0(Bouvet Island)</option>
              <option value="55">55(Brazil)</option>
              <option value="246">246(British Indian Ocean Territory)</option>
              <option value="673">673(Brunei Darussalam)</option>
              <option value="359">359(Bulgaria)</option>
              <option value="226">226(Burkina Faso)</option>
              <option value="257">257(Burundi)</option>
              <option value="855">855(Cambodia)</option>
              <option value="237">237(Cameroon)</option>
              <option value="1">1(Canada)</option>
              <option value="238">238(Cape Verde)</option>
              <option value="1345">1345(Cayman Islands)</option>
              <option value="236">236(Central African Republic)</option>
              <option value="235">235(Chad)</option>
              <option value="56">56(Chile)</option>
              <option value="86">86(China)</option>
              <option value="61">61(Christmas Island)</option>
              <option value="672">672(Cocos (Keeling) Islands)</option>
              <option value="57">57(Colombia)</option>
              <option value="269">269(Comoros)</option>
              <option value="242">242(Congo)</option>
              <option value="242">242(Congo, the Democratic Republic of the)</option>
              <option value="682">682(Cook Islands)</option>
              <option value="506">506(Costa Rica)</option>
              <option value="225">225(Cote D'Ivoire)</option>
              <option value="385">385(Croatia)</option>
              <option value="53">53(Cuba)</option>
              <option value="357">357(Cyprus)</option>
              <option value="420">420(Czech Republic)</option>
              <option value="45">45(Denmark)</option>
              <option value="253">253(Djibouti)</option>
              <option value="1767">1767(Dominica)</option>
              <option value="1809">1809(Dominican Republic)</option>
              <option value="593">593(Ecuador)</option>
              <option value="20">20(Egypt)</option>
              <option value="503">503(El Salvador)</option>
              <option value="240">240(Equatorial Guinea)</option>
              <option value="291">291(Eritrea)</option>
              <option value="372">372(Estonia)</option>
              <option value="251">251(Ethiopia)</option>
              <option value="500">500(Falkland Islands (Malvinas))</option>
              <option value="298">298(Faroe Islands)</option>
              <option value="679">679(Fiji)</option>
              <option value="358">358(Finland)</option>
              <option value="33">33(France)</option>
              <option value="594">594(French Guiana)</option>
              <option value="689">689(French Polynesia)</option>
              <option value="0">0(French Southern Territories)</option>
              <option value="241">241(Gabon)</option>
              <option value="220">220(Gambia)</option>
              <option value="995">995(Georgia)</option>
              <option value="49">49(Germany)</option>
              <option value="233">233(Ghana)</option>
              <option value="350">350(Gibraltar)</option>
              <option value="30">30(Greece)</option>
              <option value="299">299(Greenland)</option>
              <option value="1473">1473(Grenada)</option>
              <option value="590">590(Guadeloupe)</option>
              <option value="1671">1671(Guam)</option>
              <option value="502">502(Guatemala)</option>
              <option value="224">224(Guinea)</option>
              <option value="245">245(Guinea-Bissau)</option>
              <option value="592">592(Guyana)</option>
              <option value="509">509(Haiti)</option>
              <option value="0">0(Heard Island and Mcdonald Islands)</option>
              <option value="39">39(Holy See (Vatican City State))</option>
              <option value="504">504(Honduras)</option>
              <option value="852">852(Hong Kong)</option>
              <option value="36">36(Hungary)</option>
              <option value="354">354(Iceland)</option>
              <option value="91">91(India)</option>
              <option value="62">62(Indonesia)</option>
              <option value="98">98(Iran, Islamic Republic of)</option>
              <option value="964">964(Iraq)</option>
              <option value="353">353(Ireland)</option>
              <option value="972">972(Israel)</option>
              <option value="39">39(Italy)</option>
              <option value="1876">1876(Jamaica)</option>
              <option value="81">81(Japan)</option>
              <option value="962">962(Jordan)</option>
              <option value="7">7(Kazakhstan)</option>
              <option value="254">254(Kenya)</option>
              <option value="686">686(Kiribati)</option>
              <option value="850">850(Korea, Democratic People's Republic of)</option>
              <option value="82">82(Korea, Republic of)</option>
              <option value="965">965(Kuwait)</option>
              <option value="996">996(Kyrgyzstan)</option>
              <option value="856">856(Lao People's Democratic Republic)</option>
              <option value="371">371(Latvia)</option>
              <option value="961">961(Lebanon)</option>
              <option value="266">266(Lesotho)</option>
              <option value="231">231(Liberia)</option>
              <option value="218">218(Libyan Arab Jamahiriya)</option>
              <option value="423">423(Liechtenstein)</option>
              <option value="370">370(Lithuania)</option>
              <option value="352">352(Luxembourg)</option>
              <option value="853">853(Macao)</option>
              <option value="389">389(Macedonia, the Former Yugoslav Republic of)</option>
              <option value="261">261(Madagascar)</option>
              <option value="265">265(Malawi)</option>
              <option value="60">60(Malaysia)</option>
              <option value="960">960(Maldives)</option>
              <option value="223">223(Mali)</option>
              <option value="356">356(Malta)</option>
              <option value="692">692(Marshall Islands)</option>
              <option value="596">596(Martinique)</option>
              <option value="222">222(Mauritania)</option>
              <option value="230">230(Mauritius)</option>
              <option value="269">269(Mayotte)</option>
              <option value="52">52(Mexico)</option>
              <option value="691">691(Micronesia, Federated States of)</option>
              <option value="373">373(Moldova, Republic of)</option>
              <option value="377">377(Monaco)</option>
              <option value="976">976(Mongolia)</option>
              <option value="1664">1664(Montserrat)</option>
              <option value="212">212(Morocco)</option>
              <option value="258">258(Mozambique)</option>
              <option value="95">95(Myanmar)</option>
              <option value="264">264(Namibia)</option>
              <option value="674">674(Nauru)</option>
              <option value="977">977(Nepal)</option>
              <option value="31">31(Netherlands)</option>
              <option value="599">599(Netherlands Antilles)</option>
              <option value="687">687(New Caledonia)</option>
              <option value="64">64(New Zealand)</option>
              <option value="505">505(Nicaragua)</option>
              <option value="227">227(Niger)</option>
              <option value="234">234(Nigeria)</option>
              <option value="683">683(Niue)</option>
              <option value="672">672(Norfolk Island)</option>
              <option value="1670">1670(Northern Mariana Islands)</option>
              <option value="47">47(Norway)</option>
              <option value="968">968(Oman)</option>
              <option value="92">92(Pakistan)</option>
              <option value="680">680(Palau)</option>
              <option value="970">970(Palestinian Territory, Occupied)</option>
              <option value="507">507(Panama)</option>
              <option value="675">675(Papua New Guinea)</option>
              <option value="595">595(Paraguay)</option>
              <option value="51">51(Peru)</option>
              <option value="63">63(Philippines)</option>
              <option value="0">0(Pitcairn)</option>
              <option value="48">48(Poland)</option>
              <option value="351">351(Portugal)</option>
              <option value="1787">1787(Puerto Rico)</option>
              <option value="974">974(Qatar)</option>
              <option value="262">262(Reunion)</option>
              <option value="40">40(Romania)</option>
              <option value="70">70(Russian Federation)</option>
              <option value="250">250(Rwanda)</option>
              <option value="290">290(Saint Helena)</option>
              <option value="1869">1869(Saint Kitts and Nevis)</option>
              <option value="1758">1758(Saint Lucia)</option>
              <option value="508">508(Saint Pierre and Miquelon)</option>
              <option value="1784">1784(Saint Vincent and the Grenadines)</option>
              <option value="684">684(Samoa)</option>
              <option value="378">378(San Marino)</option>
              <option value="239">239(Sao Tome and Principe)</option>
              <option value="966">966(Saudi Arabia)</option>
              <option value="221">221(Senegal)</option>
              <option value="381">381(Serbia and Montenegro)</option>
              <option value="248">248(Seychelles)</option>
              <option value="232">232(Sierra Leone)</option>
              <option value="65">65(Singapore)</option>
              <option value="421">421(Slovakia)</option>
              <option value="386">386(Slovenia)</option>
              <option value="677">677(Solomon Islands)</option>
              <option value="252">252(Somalia)</option>
              <option value="27">27(South Africa)</option>
              <option value="0">0(South Georgia and the South Sandwich Islands)</option>
              <option value="34">34(Spain)</option>
              <option value="94">94(Sri Lanka)</option>
              <option value="249">249(Sudan)</option>
              <option value="597">597(Suriname)</option>
              <option value="47">47(Svalbard and Jan Mayen)</option>
              <option value="268">268(Swaziland)</option>
              <option value="46">46(Sweden)</option>
              <option value="41">41(Switzerland)</option>
              <option value="963">963(Syrian Arab Republic)</option>
              <option value="886">886(Taiwan, Province of China)</option>
              <option value="992">992(Tajikistan)</option>
              <option value="255">255(Tanzania, United Republic of)</option>
              <option value="66">66(Thailand)</option>
              <option value="670">670(Timor-Leste)</option>
              <option value="228">228(Togo)</option>
              <option value="690">690(Tokelau)</option>
              <option value="676">676(Tonga)</option>
              <option value="1868">1868(Trinidad and Tobago)</option>
              <option value="216">216(Tunisia)</option>
              <option value="90">90(Turkey)</option>
              <option value="7370">7370(Turkmenistan)</option>
              <option value="1649">1649(Turks and Caicos Islands)</option>
              <option value="688">688(Tuvalu)</option>
              <option value="256">256(Uganda)</option>
              <option value="380">380(Ukraine)</option>
              <option value="971">971(United Arab Emirates)</option>
              <option value="44">44(United Kingdom)</option>
              <option value="1">1(United States)</option>
              <option value="1">1(United States Minor Outlying Islands)</option>
              <option value="598">598(Uruguay)</option>
              <option value="998">998(Uzbekistan)</option>
              <option value="678">678(Vanuatu)</option>
              <option value="58">58(Venezuela)</option>
              <option value="84">84(Viet Nam)</option>
              <option value="1284">1284(Virgin Islands, British)</option>
              <option value="1340">1340(Virgin Islands, U.s.)</option>
              <option value="681">681(Wallis and Futuna)</option>
              <option value="212">212(Western Sahara)</option>
              <option value="967">967(Yemen)</option>
              <option value="260">260(Zambia)</option>
              <option value="263">263(Zimbabwe)</option>
            </select>
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-contact">Contact</label>
            <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="phone">
          </div>
          <div class="mb-3">
            <label class="form-label" for="country">Country</label>
            <select id="country" name="country" class="form-select">
              <option value="">Select</option>
              <option value="AFGHANISTAN">Afghanistan</option>
              <option value="ALBANIA">Albania</option>
              <option value="ALGERIA">Algeria</option>
              <option value="AMERICAN SAMOA">American Samoa</option>
              <option value="ANDORRA">Andorra</option>
              <option value="ANGOLA">Angola</option>
              <option value="ANGUILLA">Anguilla</option>
              <option value="ANTARCTICA">Antarctica</option>
              <option value="ANTIGUA AND BARBUDA">Antigua and Barbuda</option>
              <option value="ARGENTINA">Argentina</option>
              <option value="ARMENIA">Armenia</option>
              <option value="ARUBA">Aruba</option>
              <option value="AUSTRALIA">Australia</option>
              <option value="AUSTRIA">Austria</option>
              <option value="AZERBAIJAN">Azerbaijan</option>
              <option value="BAHAMAS">Bahamas</option>
              <option value="BAHRAIN">Bahrain</option>
              <option value="BANGLADESH">Bangladesh</option>
              <option value="BARBADOS">Barbados</option>
              <option value="BELARUS">Belarus</option>
              <option value="BELGIUM">Belgium</option>
              <option value="BELIZE">Belize</option>
              <option value="BENIN">Benin</option>
              <option value="BERMUDA">Bermuda</option>
              <option value="BHUTAN">Bhutan</option>
              <option value="BOLIVIA">Bolivia</option>
              <option value="BOSNIA AND HERZEGOVINA">Bosnia and Herzegovina</option>
              <option value="BOTSWANA">Botswana</option>
              <option value="BOUVET ISLAND">Bouvet Island</option>
              <option value="BRAZIL">Brazil</option>
              <option value="BRITISH INDIAN OCEAN TERRITORY">British Indian Ocean Territory</option>
              <option value="BRUNEI DARUSSALAM">Brunei Darussalam</option>
              <option value="BULGARIA">Bulgaria</option>
              <option value="BURKINA FASO">Burkina Faso</option>
              <option value="BURUNDI">Burundi</option>
              <option value="CAMBODIA">Cambodia</option>
              <option value="CAMEROON">Cameroon</option>
              <option value="CANADA">Canada</option>
              <option value="CAPE VERDE">Cape Verde</option>
              <option value="CAYMAN ISLANDS">Cayman Islands</option>
              <option value="CENTRAL AFRICAN REPUBLIC">Central African Republic</option>
              <option value="CHAD">Chad</option>
              <option value="CHILE">Chile</option>
              <option value="CHINA">China</option>
              <option value="CHRISTMAS ISLAND">Christmas Island</option>
              <option value="COCOS (KEELING) ISLANDS">Cocos (Keeling) Islands</option>
              <option value="COLOMBIA">Colombia</option>
              <option value="COMOROS">Comoros</option>
              <option value="CONGO">Congo</option>
              <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">Congo, the Democratic Republic of the</option>
              <option value="COOK ISLANDS">Cook Islands</option>
              <option value="COSTA RICA">Costa Rica</option>
              <option value="COTE D'IVOIRE">Cote D'Ivoire</option>
              <option value="CROATIA">Croatia</option>
              <option value="CUBA">Cuba</option>
              <option value="CYPRUS">Cyprus</option>
              <option value="CZECH REPUBLIC">Czech Republic</option>
              <option value="DENMARK">Denmark</option>
              <option value="DJIBOUTI">Djibouti</option>
              <option value="DOMINICA">Dominica</option>
              <option value="DOMINICAN REPUBLIC">Dominican Republic</option>
              <option value="ECUADOR">Ecuador</option>
              <option value="EGYPT">Egypt</option>
              <option value="EL SALVADOR">El Salvador</option>
              <option value="EQUATORIAL GUINEA">Equatorial Guinea</option>
              <option value="ERITREA">Eritrea</option>
              <option value="ESTONIA">Estonia</option>
              <option value="ETHIOPIA">Ethiopia</option>
              <option value="FALKLAND ISLANDS (MALVINAS)">Falkland Islands (Malvinas)</option>
              <option value="FAROE ISLANDS">Faroe Islands</option>
              <option value="FIJI">Fiji</option>
              <option value="FINLAND">Finland</option>
              <option value="FRANCE">France</option>
              <option value="FRENCH GUIANA">French Guiana</option>
              <option value="FRENCH POLYNESIA">French Polynesia</option>
              <option value="FRENCH SOUTHERN TERRITORIES">French Southern Territories</option>
              <option value="GABON">Gabon</option>
              <option value="GAMBIA">Gambia</option>
              <option value="GEORGIA">Georgia</option>
              <option value="GERMANY">Germany</option>
              <option value="GHANA">Ghana</option>
              <option value="GIBRALTAR">Gibraltar</option>
              <option value="GREECE">Greece</option>
              <option value="GREENLAND">Greenland</option>
              <option value="GRENADA">Grenada</option>
              <option value="GUADELOUPE">Guadeloupe</option>
              <option value="GUAM">Guam</option>
              <option value="GUATEMALA">Guatemala</option>
              <option value="GUINEA">Guinea</option>
              <option value="GUINEA-BISSAU">Guinea-Bissau</option>
              <option value="GUYANA">Guyana</option>
              <option value="HAITI">Haiti</option>
              <option value="HEARD ISLAND AND MCDONALD ISLANDS">Heard Island and Mcdonald Islands</option>
              <option value="HOLY SEE (VATICAN CITY STATE)">Holy See (Vatican City State)</option>
              <option value="HONDURAS">Honduras</option>
              <option value="HONG KONG">Hong Kong</option>
              <option value="HUNGARY">Hungary</option>
              <option value="ICELAND">Iceland</option>
              <option value="INDIA">India</option>
              <option value="INDONESIA">Indonesia</option>
              <option value="IRAN, ISLAMIC REPUBLIC OF">Iran, Islamic Republic of</option>
              <option value="IRAQ">Iraq</option>
              <option value="IRELAND">Ireland</option>
              <option value="ISRAEL">Israel</option>
              <option value="ITALY">Italy</option>
              <option value="JAMAICA">Jamaica</option>
              <option value="JAPAN">Japan</option>
              <option value="JORDAN">Jordan</option>
              <option value="KAZAKHSTAN">Kazakhstan</option>
              <option value="KENYA">Kenya</option>
              <option value="KIRIBATI">Kiribati</option>
              <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">Korea, Democratic People's Republic of</option>
              <option value="KOREA, REPUBLIC OF">Korea, Republic of</option>
              <option value="KUWAIT">Kuwait</option>
              <option value="KYRGYZSTAN">Kyrgyzstan</option>
              <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">Lao People's Democratic Republic</option>
              <option value="LATVIA">Latvia</option>
              <option value="LEBANON">Lebanon</option>
              <option value="LESOTHO">Lesotho</option>
              <option value="LIBERIA">Liberia</option>
              <option value="LIBYAN ARAB JAMAHIRIYA">Libyan Arab Jamahiriya</option>
              <option value="LIECHTENSTEIN">Liechtenstein</option>
              <option value="LITHUANIA">Lithuania</option>
              <option value="LUXEMBOURG">Luxembourg</option>
              <option value="MACAO">Macao</option>
              <option value="MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF">Macedonia, the Former Yugoslav Republic of</option>
              <option value="MADAGASCAR">Madagascar</option>
              <option value="MALAWI">Malawi</option>
              <option value="MALAYSIA">Malaysia</option>
              <option value="MALDIVES">Maldives</option>
              <option value="MALI">Mali</option>
              <option value="MALTA">Malta</option>
              <option value="MARSHALL ISLANDS">Marshall Islands</option>
              <option value="MARTINIQUE">Martinique</option>
              <option value="MAURITANIA">Mauritania</option>
              <option value="MAURITIUS">Mauritius</option>
              <option value="MAYOTTE">Mayotte</option>
              <option value="MEXICO">Mexico</option>
              <option value="MICRONESIA, FEDERATED STATES OF">Micronesia, Federated States of</option>
              <option value="MOLDOVA, REPUBLIC OF">Moldova, Republic of</option>
              <option value="MONACO">Monaco</option>
              <option value="MONGOLIA">Mongolia</option>
              <option value="MONTSERRAT">Montserrat</option>
              <option value="MOROCCO">Morocco</option>
              <option value="MOZAMBIQUE">Mozambique</option>
              <option value="MYANMAR">Myanmar</option>
              <option value="NAMIBIA">Namibia</option>
              <option value="NAURU">Nauru</option>
              <option value="NEPAL">Nepal</option>
              <option value="NETHERLANDS">Netherlands</option>
              <option value="NETHERLANDS ANTILLES">Netherlands Antilles</option>
              <option value="NEW CALEDONIA">New Caledonia</option>
              <option value="NEW ZEALAND">New Zealand</option>
              <option value="NICARAGUA">Nicaragua</option>
              <option value="NIGER">Niger</option>
              <option value="NIGERIA">Nigeria</option>
              <option value="NIUE">Niue</option>
              <option value="NORFOLK ISLAND">Norfolk Island</option>
              <option value="NORTHERN MARIANA ISLANDS">Northern Mariana Islands</option>
              <option value="NORWAY">Norway</option>
              <option value="OMAN">Oman</option>
              <option value="PAKISTAN">Pakistan</option>
              <option value="PALAU">Palau</option>
              <option value="PALESTINIAN TERRITORY, OCCUPIED">Palestinian Territory, Occupied</option>
              <option value="PANAMA">Panama</option>
              <option value="PAPUA NEW GUINEA">Papua New Guinea</option>
              <option value="PARAGUAY">Paraguay</option>
              <option value="PERU">Peru</option>
              <option value="PHILIPPINES">Philippines</option>
              <option value="PITCAIRN">Pitcairn</option>
              <option value="POLAND">Poland</option>
              <option value="PORTUGAL">Portugal</option>
              <option value="PUERTO RICO">Puerto Rico</option>
              <option value="QATAR">Qatar</option>
              <option value="REUNION">Reunion</option>
              <option value="ROMANIA">Romania</option>
              <option value="RUSSIAN FEDERATION">Russian Federation</option>
              <option value="RWANDA">Rwanda</option>
              <option value="SAINT HELENA">Saint Helena</option>
              <option value="SAINT KITTS AND NEVIS">Saint Kitts and Nevis</option>
              <option value="SAINT LUCIA">Saint Lucia</option>
              <option value="SAINT PIERRE AND MIQUELON">Saint Pierre and Miquelon</option>
              <option value="SAINT VINCENT AND THE GRENADINES">Saint Vincent and the Grenadines</option>
              <option value="SAMOA">Samoa</option>
              <option value="SAN MARINO">San Marino</option>
              <option value="SAO TOME AND PRINCIPE">Sao Tome and Principe</option>
              <option value="SAUDI ARABIA">Saudi Arabia</option>
              <option value="SENEGAL">Senegal</option>
              <option value="SERBIA AND MONTENEGRO">Serbia and Montenegro</option>
              <option value="SEYCHELLES">Seychelles</option>
              <option value="SIERRA LEONE">Sierra Leone</option>
              <option value="SINGAPORE">Singapore</option>
              <option value="SLOVAKIA">Slovakia</option>
              <option value="SLOVENIA">Slovenia</option>
              <option value="SOLOMON ISLANDS">Solomon Islands</option>
              <option value="SOMALIA">Somalia</option>
              <option value="SOUTH AFRICA">South Africa</option>
              <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">South Georgia and the South Sandwich Islands</option>
              <option value="SPAIN">Spain</option>
              <option value="SRI LANKA">Sri Lanka</option>
              <option value="SUDAN">Sudan</option>
              <option value="SURINAME">Suriname</option>
              <option value="SVALBARD AND JAN MAYEN">Svalbard and Jan Mayen</option>
              <option value="SWAZILAND">Swaziland</option>
              <option value="SWEDEN">Sweden</option>
              <option value="SWITZERLAND">Switzerland</option>
              <option value="SYRIAN ARAB REPUBLIC">Syrian Arab Republic</option>
              <option value="TAIWAN, PROVINCE OF CHINA">Taiwan, Province of China</option>
              <option value="TAJIKISTAN">Tajikistan</option>
              <option value="TANZANIA, UNITED REPUBLIC OF">Tanzania, United Republic of</option>
              <option value="THAILAND">Thailand</option>
              <option value="TIMOR-LESTE">Timor-Leste</option>
              <option value="TOGO">Togo</option>
              <option value="TOKELAU">Tokelau</option>
              <option value="TONGA">Tonga</option>
              <option value="TRINIDAD AND TOBAGO">Trinidad and Tobago</option>
              <option value="TUNISIA">Tunisia</option>
              <option value="TURKEY">Turkey</option>
              <option value="TURKMENISTAN">Turkmenistan</option>
              <option value="TURKS AND CAICOS ISLANDS">Turks and Caicos Islands</option>
              <option value="TUVALU">Tuvalu</option>
              <option value="UGANDA">Uganda</option>
              <option value="UKRAINE">Ukraine</option>
              <option value="UNITED ARAB EMIRATES">United Arab Emirates</option>
              <option value="UNITED KINGDOM">United Kingdom</option>
              <option value="UNITED STATES">United States</option>
              <option value="UNITED STATES MINOR OUTLYING ISLANDS">United States Minor Outlying Islands</option>
              <option value="URUGUAY">Uruguay</option>
              <option value="UZBEKISTAN">Uzbekistan</option>
              <option value="VANUATU">Vanuatu</option>
              <option value="VENEZUELA">Venezuela</option>
              <option value="VIET NAM">Viet Nam</option>
              <option value="VIRGIN ISLANDS, BRITISH">Virgin Islands, British</option>
              <option value="VIRGIN ISLANDS, U.S.">Virgin Islands, U.s.</option>
              <option value="WALLIS AND FUTUNA">Wallis and Futuna</option>
              <option value="WESTERN SAHARA">Western Sahara</option>
              <option value="YEMEN">Yemen</option>
              <option value="ZAMBIA">Zambia</option>
              <option value="ZIMBABWE">Zimbabwe</option>
            </select>
          </div>
          <input type="hidden" name="userrole" value="Client">
          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mb-3">
              <div class="form-check @error('terms') is-invalid @enderror">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" />
                <label class="form-check-label" for="terms">
                  I agree to the
                  <a href="{{ route('policy.show') }}" target="_blank">privacy policy</a> &
                  <a href="{{ route('terms.show') }}" target="_blank">terms</a>
                </label>
              </div>
              @error('terms')
                <div class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </div>
              @enderror
            </div>
          @endif
          <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
        </form>

        <p class="text-center">
          <span>Already have an account?</span>
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <span>Sign in</span>
          </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
@endsection
