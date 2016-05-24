<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/system_settings/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'systemform', 'target' => '_top', 'enctype' => 'multipart/form-data'));
                                ?>
                  <div class=""> 
                                                <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"><?php echo ucwords("System Name"); ?><span style="color:red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="system_name" id="system_name" value="<?php echo $this->db->get_where('system_setting', array('type' => 'system_name'))->row()->description; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"><?php echo ucwords("Phone"); ?><span style="color:red">*</span></label>
<?php $country_code =  $this->db->get_where('system_setting', array('type' => 'country_code'))->row()->description; ?>
                                                <div class="col-sm-9">
                                                    <div class="col-sm-3 p-l-0">
                                                        <select name="countryCode" id="countryCode" class="form-control">  
                                                            <option data-countryCode="DZ" value="213" <?php if($country_code=="213"){ echo "selected=selected"; } ?>>Algeria (+213)</option>
                                                            <option data-countryCode="AD" value="376"  <?php if($country_code=="376"){ echo "selected=selected"; } ?>>Andorra (+376)</option>
                                                            <option data-countryCode="AO" value="244"  <?php if($country_code=="244"){ echo "selected=selected"; } ?>>Angola (+244)</option>
                                                            <option data-countryCode="AI" value="1264"  <?php if($country_code=="1264"){ echo "selected=selected"; } ?>>Anguilla (+1264)</option>
                                                            <option data-countryCode="AG" value="1268"  <?php if($country_code=="1268"){ echo "selected=selected"; } ?>>Antigua &amp; Barbuda (+1268)</option>
                                                            <option data-countryCode="AR" value="54"  <?php if($country_code=="54"){ echo "selected=selected"; } ?>>Argentina (+54)</option>
                                                            <option data-countryCode="AM" value="374"  <?php if($country_code=="374"){ echo "selected=selected"; } ?>>Armenia (+374)</option>
                                                            <option data-countryCode="AW" value="297"   <?php if($country_code=="297"){ echo "selected=selected"; } ?>>Aruba (+297)</option>
                                                            <option data-countryCode="AU" value="61"  <?php if($country_code=="61"){ echo "selected=selected"; } ?>>Australia (+61)</option>
                                                            <option data-countryCode="AT" value="43"  <?php if($country_code=="43"){ echo "selected=selected"; } ?>>Austria (+43)</option>
                                                            <option data-countryCode="AZ" value="994"  <?php if($country_code=="994"){ echo "selected=selected"; } ?>>Azerbaijan (+994)</option>
                                                            <option data-countryCode="BS" value="1242"  <?php if($country_code=="1242"){ echo "selected=selected"; } ?>>Bahamas (+1242)</option>
                                                            <option data-countryCode="BH" value="973"  <?php if($country_code=="973"){ echo "selected=selected"; } ?>>Bahrain (+973)</option>
                                                            <option data-countryCode="BD" value="880"  <?php if($country_code=="880"){ echo "selected=selected"; } ?>>Bangladesh (+880)</option>
                                                            <option data-countryCode="BB" value="1246"  <?php if($country_code=="1246"){ echo "selected=selected"; } ?>>Barbados (+1246)</option>
                                                            <option data-countryCode="BY" value="375"  <?php if($country_code=="375"){ echo "selected=selected"; } ?>>Belarus (+375)</option>
                                                            <option data-countryCode="BE" value="32"  <?php if($country_code=="32"){ echo "selected=selected"; } ?>>Belgium (+32)</option>
                                                            <option data-countryCode="BZ" value="501"  <?php if($country_code=="501"){ echo "selected=selected"; } ?>>Belize (+501)</option>
                                                            <option data-countryCode="BJ" value="229"  <?php if($country_code=="229"){ echo "selected=selected"; } ?>>Benin (+229)</option>
                                                            <option data-countryCode="BM" value="1441"  <?php if($country_code=="1441"){ echo "selected=selected"; } ?>>Bermuda (+1441)</option>
                                                            <option data-countryCode="BT" value="975"  <?php if($country_code=="975"){ echo "selected=selected"; } ?>>Bhutan (+975)</option>
                                                            <option data-countryCode="BO" value="591"  <?php if($country_code=="591"){ echo "selected=selected"; } ?>>Bolivia (+591)</option>
                                                            <option data-countryCode="BA" value="387"  <?php if($country_code=="387"){ echo "selected=selected"; } ?>>Bosnia Herzegovina (+387)</option>
                                                            <option data-countryCode="BW" value="267"  <?php if($country_code=="267"){ echo "selected=selected"; } ?>>Botswana (+267)</option>
                                                            <option data-countryCode="BR" value="55"  <?php if($country_code=="55"){ echo "selected=selected"; } ?>>Brazil (+55)</option>
                                                            <option data-countryCode="BN" value="673"  <?php if($country_code=="673"){ echo "selected=selected"; } ?>>Brunei (+673)</option>
                                                            <option data-countryCode="BG" value="359"  <?php if($country_code=="359"){ echo "selected=selected"; } ?>>Bulgaria (+359)</option>
                                                            <option data-countryCode="BF" value="226"  <?php if($country_code=="226"){ echo "selected=selected"; } ?>>Burkina Faso (+226)</option>
                                                            <option data-countryCode="BI" value="257"  <?php if($country_code=="257"){ echo "selected=selected"; } ?>>Burundi (+257)</option>
                                                            <option data-countryCode="KH" value="855"  <?php if($country_code=="855"){ echo "selected=selected"; } ?>>Cambodia (+855)</option>
                                                            <option data-countryCode="CM" value="237"  <?php if($country_code=="237"){ echo "selected=selected"; } ?>>Cameroon (+237)</option>
                                                            <option data-countryCode="CA" value="1"  <?php if($country_code=="1"){ echo "selected=selected"; } ?>>Canada (+1)</option>
                                                            <option data-countryCode="CV" value="238"  <?php if($country_code=="238"){ echo "selected=selected"; } ?>>Cape Verde Islands (+238)</option>
                                                            <option data-countryCode="KY" value="1345"  <?php if($country_code=="1345"){ echo "selected=selected"; } ?>>Cayman Islands (+1345)</option>
                                                            <option data-countryCode="CF" value="236"  <?php if($country_code=="236"){ echo "selected=selected"; } ?>>Central African Republic (+236)</option>
                                                            <option data-countryCode="CL" value="56"  <?php if($country_code=="56"){ echo "selected=selected"; } ?>>Chile (+56)</option>
                                                            <option data-countryCode="CN" value="86"  <?php if($country_code=="86"){ echo "selected=selected"; } ?>>China (+86)</option>
                                                            <option data-countryCode="CO" value="57"  <?php if($country_code=="57"){ echo "selected=selected"; } ?>>Colombia (+57)</option>
                                                            <option data-countryCode="KM" value="269"  <?php if($country_code=="269"){ echo "selected=selected"; } ?>>Comoros (+269)</option>
                                                            <option data-countryCode="CG" value="242"  <?php if($country_code=="242"){ echo "selected=selected"; } ?>>Congo (+242)</option>
                                                            <option data-countryCode="CK" value="682"  <?php if($country_code=="682"){ echo "selected=selected"; } ?>>Cook Islands (+682)</option>
                                                            <option data-countryCode="CR" value="506"  <?php if($country_code=="506"){ echo "selected=selected"; } ?>>Costa Rica (+506)</option>
                                                            <option data-countryCode="HR" value="385"  <?php if($country_code=="385"){ echo "selected=selected"; } ?>>Croatia (+385)</option>
                                                            <option data-countryCode="CU" value="53"  <?php if($country_code=="53"){ echo "selected=selected"; } ?>>Cuba (+53)</option>
                                                            <option data-countryCode="CY" value="90392"  <?php if($country_code=="90392"){ echo "selected=selected"; } ?>>Cyprus North (+90392)</option>
                                                            <option data-countryCode="CY" value="357"  <?php if($country_code=="357"){ echo "selected=selected"; } ?>>Cyprus South (+357)</option>
                                                            <option data-countryCode="CZ" value="42"  <?php if($country_code=="42"){ echo "selected=selected"; } ?>>Czech Republic (+42)</option>
                                                            <option data-countryCode="DK" value="45"  <?php if($country_code=="45"){ echo "selected=selected"; } ?>>Denmark (+45)</option>
                                                            <option data-countryCode="DJ" value="253"  <?php if($country_code=="253"){ echo "selected=selected"; } ?>>Djibouti (+253)</option>
                                                            <option data-countryCode="DM" value="1809"  <?php if($country_code=="1809"){ echo "selected=selected"; } ?>>Dominica (+1809)</option>
                                                            <option data-countryCode="DO" value="1809"  <?php if($country_code=="1809"){ echo "selected=selected"; } ?>>Dominican Republic (+1809)</option>
                                                            <option data-countryCode="EC" value="593"  <?php if($country_code=="593"){ echo "selected=selected"; } ?>>Ecuador (+593)</option>
                                                            <option data-countryCode="EG" value="20"  <?php if($country_code=="20"){ echo "selected=selected"; } ?>>Egypt (+20)</option>
                                                            <option data-countryCode="SV" value="503"  <?php if($country_code=="503"){ echo "selected=selected"; } ?>>El Salvador (+503)</option>
                                                            <option data-countryCode="GQ" value="240"  <?php if($country_code=="240"){ echo "selected=selected"; } ?>>Equatorial Guinea (+240)</option>
                                                            <option data-countryCode="ER" value="291"  <?php if($country_code=="291"){ echo "selected=selected"; } ?>>Eritrea (+291)</option>
                                                            <option data-countryCode="EE" value="372"  <?php if($country_code=="372"){ echo "selected=selected"; } ?>>Estonia (+372)</option>
                                                            <option data-countryCode="ET" value="251"  <?php if($country_code=="251"){ echo "selected=selected"; } ?>>Ethiopia (+251)</option>
                                                            <option data-countryCode="FK" value="500"  <?php if($country_code=="500"){ echo "selected=selected"; } ?>>Falkland Islands (+500)</option>
                                                            <option data-countryCode="FO" value="298"  <?php if($country_code=="298"){ echo "selected=selected"; } ?>>Faroe Islands (+298)</option>
                                                            <option data-countryCode="FJ" value="679"  <?php if($country_code=="679"){ echo "selected=selected"; } ?>>Fiji (+679)</option>
                                                            <option data-countryCode="FI" value="358"  <?php if($country_code=="358"){ echo "selected=selected"; } ?>>Finland (+358)</option>
                                                            <option data-countryCode="FR" value="33"  <?php if($country_code=="33"){ echo "selected=selected"; } ?>>France (+33)</option>
                                                            <option data-countryCode="GF" value="594"  <?php if($country_code=="594"){ echo "selected=selected"; } ?>>French Guiana (+594)</option>
                                                            <option data-countryCode="PF" value="689"  <?php if($country_code=="689"){ echo "selected=selected"; } ?>>French Polynesia (+689)</option>
                                                            <option data-countryCode="GA" value="241"  <?php if($country_code=="241"){ echo "selected=selected"; } ?>>Gabon (+241)</option>
                                                            <option data-countryCode="GM" value="220"  <?php if($country_code=="220"){ echo "selected=selected"; } ?>>Gambia (+220)</option>
                                                            <option data-countryCode="GE" value="7880"  <?php if($country_code=="7880"){ echo "selected=selected"; } ?>>Georgia (+7880)</option>
                                                            <option data-countryCode="DE" value="49"  <?php if($country_code=="49"){ echo "selected=selected"; } ?>>Germany (+49)</option>
                                                            <option data-countryCode="GH" value="233"  <?php if($country_code=="233"){ echo "selected=selected"; } ?>>Ghana (+233)</option>
                                                            <option data-countryCode="GI" value="350"  <?php if($country_code=="350"){ echo "selected=selected"; } ?>>Gibraltar (+350)</option>
                                                            <option data-countryCode="GR" value="30"  <?php if($country_code=="30"){ echo "selected=selected"; } ?>>Greece (+30)</option>
                                                            <option data-countryCode="GL" value="299"  <?php if($country_code=="299"){ echo "selected=selected"; } ?>>Greenland (+299)</option>
                                                            <option data-countryCode="GD" value="1473"  <?php if($country_code=="1473"){ echo "selected=selected"; } ?>>Grenada (+1473)</option>
                                                            <option data-countryCode="GP" value="590"  <?php if($country_code=="590"){ echo "selected=selected"; } ?>>Guadeloupe (+590)</option>
                                                            <option data-countryCode="GU" value="671"  <?php if($country_code=="671"){ echo "selected=selected"; } ?>>Guam (+671)</option>
                                                            <option data-countryCode="GT" value="502"  <?php if($country_code=="502"){ echo "selected=selected"; } ?>>Guatemala (+502)</option>
                                                            <option data-countryCode="GN" value="224"  <?php if($country_code=="224"){ echo "selected=selected"; } ?>>Guinea (+224)</option>
                                                            <option data-countryCode="GW" value="245"  <?php if($country_code=="245"){ echo "selected=selected"; } ?>>Guinea - Bissau (+245)</option>
                                                            <option data-countryCode="GY" value="592"  <?php if($country_code=="592"){ echo "selected=selected"; } ?>>Guyana (+592)</option>
                                                            <option data-countryCode="HT" value="509"  <?php if($country_code=="509"){ echo "selected=selected"; } ?>>Haiti (+509)</option>
                                                            <option data-countryCode="HN" value="504"  <?php if($country_code=="504"){ echo "selected=selected"; } ?>>Honduras (+504)</option>
                                                            <option data-countryCode="HK" value="852"  <?php if($country_code=="852"){ echo "selected=selected"; } ?>>Hong Kong (+852)</option>
                                                            <option data-countryCode="HU" value="36"  <?php if($country_code=="36"){ echo "selected=selected"; } ?>>Hungary (+36)</option>
                                                            <option data-countryCode="IS" value="354"  <?php if($country_code=="354"){ echo "selected=selected"; } ?>>Iceland (+354)</option>
                                                            <option data-countryCode="IN" value="91"  <?php if($country_code=="91"){ echo "selected=selected"; } ?>>India (+91)</option>
                                                            <option data-countryCode="ID" value="62"   <?php if($country_code=="62"){ echo "selected=selected"; } ?>>Indonesia (+62)</option>
                                                            <option data-countryCode="IR" value="98"  <?php if($country_code=="98"){ echo "selected=selected"; } ?>>Iran (+98)</option>
                                                            <option data-countryCode="IQ" value="964"  <?php if($country_code=="964"){ echo "selected=selected"; } ?>>Iraq (+964)</option>
                                                            <option data-countryCode="IE" value="353"  <?php if($country_code=="353"){ echo "selected=selected"; } ?>>Ireland (+353)</option>
                                                            <option data-countryCode="IL" value="972"  <?php if($country_code=="972"){ echo "selected=selected"; } ?>>Israel (+972)</option>
                                                            <option data-countryCode="IT" value="39"  <?php if($country_code=="39"){ echo "selected=selected"; } ?>>Italy (+39)</option>
                                                            <option data-countryCode="JM" value="1876"  <?php if($country_code=="1876"){ echo "selected=selected"; } ?>>Jamaica (+1876)</option>
                                                            <option data-countryCode="JP" value="81"  <?php if($country_code=="81"){ echo "selected=selected"; } ?>>Japan (+81)</option>
                                                            <option data-countryCode="JO" value="962"  <?php if($country_code=="962"){ echo "selected=selected"; } ?>>Jordan (+962)</option>
                                                            <option data-countryCode="KZ" value="7"  <?php if($country_code=="7"){ echo "selected=selected"; } ?>>Kazakhstan (+7)</option>
                                                            <option data-countryCode="KE" value="254"  <?php if($country_code=="254"){ echo "selected=selected"; } ?>>Kenya (+254)</option>
                                                            <option data-countryCode="KI" value="686"  <?php if($country_code=="686"){ echo "selected=selected"; } ?>>Kiribati (+686)</option>
                                                            <option data-countryCode="KP" value="850"  <?php if($country_code=="850"){ echo "selected=selected"; } ?>>Korea North (+850)</option>
                                                            <option data-countryCode="KR" value="82"  <?php if($country_code=="82"){ echo "selected=selected"; } ?>>Korea South (+82)</option>
                                                            <option data-countryCode="KW" value="965"  <?php if($country_code=="965"){ echo "selected=selected"; } ?>>Kuwait (+965)</option>
                                                            <option data-countryCode="KG" value="996"  <?php if($country_code=="996"){ echo "selected=selected"; } ?>>Kyrgyzstan (+996)</option>
                                                            <option data-countryCode="LA" value="856"  <?php if($country_code=="856"){ echo "selected=selected"; } ?>>Laos (+856)</option>
                                                            <option data-countryCode="LV" value="371"  <?php if($country_code=="371"){ echo "selected=selected"; } ?>>Latvia (+371)</option>
                                                            <option data-countryCode="LB" value="961"  <?php if($country_code=="961"){ echo "selected=selected"; } ?>>Lebanon (+961)</option>
                                                            <option data-countryCode="LS" value="266"  <?php if($country_code=="266"){ echo "selected=selected"; } ?>>Lesotho (+266)</option>
                                                            <option data-countryCode="LR" value="231"  <?php if($country_code=="231"){ echo "selected=selected"; } ?>>Liberia (+231)</option>
                                                            <option data-countryCode="LY" value="218"  <?php if($country_code=="218"){ echo "selected=selected"; } ?>>Libya (+218)</option>
                                                            <option data-countryCode="LI" value="417"  <?php if($country_code=="417"){ echo "selected=selected"; } ?>>Liechtenstein (+417)</option>
                                                            <option data-countryCode="LT" value="370"  <?php if($country_code=="370"){ echo "selected=selected"; } ?>>Lithuania (+370)</option>
                                                            <option data-countryCode="LU" value="352"  <?php if($country_code=="352"){ echo "selected=selected"; } ?>>Luxembourg (+352)</option>
                                                            <option data-countryCode="MO" value="853"  <?php if($country_code=="853"){ echo "selected=selected"; } ?>>Macao (+853)</option>
                                                            <option data-countryCode="MK" value="389"  <?php if($country_code=="389"){ echo "selected=selected"; } ?>>Macedonia (+389)</option>
                                                            <option data-countryCode="MG" value="261"  <?php if($country_code=="261"){ echo "selected=selected"; } ?>>Madagascar (+261)</option>
                                                            <option data-countryCode="MW" value="265"  <?php if($country_code=="265"){ echo "selected=selected"; } ?>>Malawi (+265)</option>
                                                            <option data-countryCode="MY" value="60"  <?php if($country_code=="60"){ echo "selected=selected"; } ?>>Malaysia (+60)</option>
                                                            <option data-countryCode="MV" value="960"  <?php if($country_code=="960"){ echo "selected=selected"; } ?>>Maldives (+960)</option>
                                                            <option data-countryCode="ML" value="223"  <?php if($country_code=="223"){ echo "selected=selected"; } ?>>Mali (+223)</option>
                                                            <option data-countryCode="MT" value="356"  <?php if($country_code=="356"){ echo "selected=selected"; } ?>>Malta (+356)</option>
                                                            <option data-countryCode="MH" value="692"  <?php if($country_code=="692"){ echo "selected=selected"; } ?>>Marshall Islands (+692)</option>
                                                            <option data-countryCode="MQ" value="596"  <?php if($country_code=="596"){ echo "selected=selected"; } ?>>Martinique (+596)</option>
                                                            <option data-countryCode="MR" value="222"  <?php if($country_code=="222"){ echo "selected=selected"; } ?>>Mauritania (+222)</option>
                                                            <option data-countryCode="YT" value="269"  <?php if($country_code=="269"){ echo "selected=selected"; } ?>>Mayotte (+269)</option>
                                                            <option data-countryCode="MX" value="52"  <?php if($country_code=="52"){ echo "selected=selected"; } ?>>Mexico (+52)</option>
                                                            <option data-countryCode="FM" value="691"  <?php if($country_code=="691"){ echo "selected=selected"; } ?>>Micronesia (+691)</option>
                                                            <option data-countryCode="MD" value="373"  <?php if($country_code=="373"){ echo "selected=selected"; } ?>>Moldova (+373)</option>
                                                            <option data-countryCode="MC" value="377"  <?php if($country_code=="377"){ echo "selected=selected"; } ?>>Monaco (+377)</option>
                                                            <option data-countryCode="MN" value="976"  <?php if($country_code=="976"){ echo "selected=selected"; } ?>>Mongolia (+976)</option>
                                                            <option data-countryCode="MS" value="1664"  <?php if($country_code=="1664"){ echo "selected=selected"; } ?>>Montserrat (+1664)</option>
                                                            <option data-countryCode="MA" value="212"  <?php if($country_code=="212"){ echo "selected=selected"; } ?>>Morocco (+212)</option>
                                                            <option data-countryCode="MZ" value="258"  <?php if($country_code=="258"){ echo "selected=selected"; } ?>>Mozambique (+258)</option>
                                                            <option data-countryCode="MN" value="95"  <?php if($country_code=="95"){ echo "selected=selected"; } ?>>Myanmar (+95)</option>
                                                            <option data-countryCode="NA" value="264"  <?php if($country_code=="264"){ echo "selected=selected"; } ?>>Namibia (+264)</option>
                                                            <option data-countryCode="NR" value="674"  <?php if($country_code=="674"){ echo "selected=selected"; } ?>>Nauru (+674)</option>
                                                            <option data-countryCode="NP" value="977"  <?php if($country_code=="977"){ echo "selected=selected"; } ?>>Nepal (+977)</option>
                                                            <option data-countryCode="NL" value="31"  <?php if($country_code=="31"){ echo "selected=selected"; } ?>>Netherlands (+31)</option>
                                                            <option data-countryCode="NC" value="687"  <?php if($country_code=="687"){ echo "selected=selected"; } ?>>New Caledonia (+687)</option>
                                                            <option data-countryCode="NZ" value="64"  <?php if($country_code=="64"){ echo "selected=selected"; } ?>>New Zealand (+64)</option>
                                                            <option data-countryCode="NI" value="505"  <?php if($country_code=="505"){ echo "selected=selected"; } ?>>Nicaragua (+505)</option>
                                                            <option data-countryCode="NE" value="227"  <?php if($country_code=="227"){ echo "selected=selected"; } ?>>Niger (+227)</option>
                                                            <option data-countryCode="NG" value="234"  <?php if($country_code=="234"){ echo "selected=selected"; } ?>>Nigeria (+234)</option>
                                                            <option data-countryCode="NU" value="683"  <?php if($country_code=="683"){ echo "selected=selected"; } ?>>Niue (+683)</option>
                                                            <option data-countryCode="NF" value="672"  <?php if($country_code=="672"){ echo "selected=selected"; } ?>>Norfolk Islands (+672)</option>
                                                            <option data-countryCode="NP" value="670"  <?php if($country_code=="670"){ echo "selected=selected"; } ?>>Northern Marianas (+670)</option>
                                                            <option data-countryCode="NO" value="47"  <?php if($country_code=="47"){ echo "selected=selected"; } ?>>Norway (+47)</option>
                                                            <option data-countryCode="OM" value="968"  <?php if($country_code=="968"){ echo "selected=selected"; } ?>>Oman (+968)</option>
                                                            <option data-countryCode="PW" value="680"  <?php if($country_code=="680"){ echo "selected=selected"; } ?>>Palau (+680)</option>
                                                            <option data-countryCode="PA" value="507"  <?php if($country_code=="507"){ echo "selected=selected"; } ?>>Panama (+507)</option>
                                                            <option data-countryCode="PG" value="675"  <?php if($country_code=="675"){ echo "selected=selected"; } ?>>Papua New Guinea (+675)</option>
                                                            <option data-countryCode="PY" value="595"  <?php if($country_code=="595"){ echo "selected=selected"; } ?>>Paraguay (+595)</option>
                                                            <option data-countryCode="PE" value="51"  <?php if($country_code=="51"){ echo "selected=selected"; } ?>>Peru (+51)</option>
                                                            <option data-countryCode="PH" value="63"  <?php if($country_code=="63"){ echo "selected=selected"; } ?>>Philippines (+63)</option>
                                                            <option data-countryCode="PL" value="48"  <?php if($country_code=="48"){ echo "selected=selected"; } ?>>Poland (+48)</option>
                                                            <option data-countryCode="PT" value="351"  <?php if($country_code=="351"){ echo "selected=selected"; } ?>>Portugal (+351)</option>
                                                            <option data-countryCode="PR" value="1787"  <?php if($country_code=="1787"){ echo "selected=selected"; } ?>>Puerto Rico (+1787)</option>
                                                            <option data-countryCode="QA" value="974"  <?php if($country_code=="974"){ echo "selected=selected"; } ?>>Qatar (+974)</option>
                                                            <option data-countryCode="RE" value="262"  <?php if($country_code=="262"){ echo "selected=selected"; } ?>>Reunion (+262)</option>
                                                            <option data-countryCode="RO" value="40"  <?php if($country_code=="40"){ echo "selected=selected"; } ?>>Romania (+40)</option>
                                                            <option data-countryCode="RU" value="7"  <?php if($country_code=="7"){ echo "selected=selected"; } ?>>Russia (+7)</option>
                                                            <option data-countryCode="RW" value="250"  <?php if($country_code=="250"){ echo "selected=selected"; } ?>>Rwanda (+250)</option>
                                                            <option data-countryCode="SM" value="378"  <?php if($country_code=="378"){ echo "selected=selected"; } ?>>San Marino (+378)</option>
                                                            <option data-countryCode="ST" value="239"  <?php if($country_code=="239"){ echo "selected=selected"; } ?>>Sao Tome &amp; Principe (+239)</option>
                                                            <option data-countryCode="SA" value="966"  <?php if($country_code=="966"){ echo "selected=selected"; } ?>>Saudi Arabia (+966)</option>
                                                            <option data-countryCode="SN" value="221"  <?php if($country_code=="221"){ echo "selected=selected"; } ?>>Senegal (+221)</option>
                                                            <option data-countryCode="CS" value="381"  <?php if($country_code=="381"){ echo "selected=selected"; } ?>>Serbia (+381)</option>
                                                            <option data-countryCode="SC" value="248"  <?php if($country_code=="248"){ echo "selected=selected"; } ?>>Seychelles (+248)</option>
                                                            <option data-countryCode="SL" value="232"  <?php if($country_code=="232"){ echo "selected=selected"; } ?>>Sierra Leone (+232)</option>
                                                            <option data-countryCode="SG" value="65"  <?php if($country_code=="65"){ echo "selected=selected"; } ?>>Singapore (+65)</option>
                                                            <option data-countryCode="SK" value="421"  <?php if($country_code=="421"){ echo "selected=selected"; } ?>>Slovak Republic (+421)</option>
                                                            <option data-countryCode="SI" value="386"  <?php if($country_code=="386"){ echo "selected=selected"; } ?>>Slovenia (+386)</option>
                                                            <option data-countryCode="SB" value="677"  <?php if($country_code=="677"){ echo "selected=selected"; } ?>>Solomon Islands (+677)</option>
                                                            <option data-countryCode="SO" value="252"  <?php if($country_code=="252"){ echo "selected=selected"; } ?>>Somalia (+252)</option>
                                                            <option data-countryCode="ZA" value="27"  <?php if($country_code=="27"){ echo "selected=selected"; } ?>>South Africa (+27)</option>
                                                            <option data-countryCode="ES" value="34"  <?php if($country_code=="34"){ echo "selected=selected"; } ?>>Spain (+34)</option>
                                                            <option data-countryCode="LK" value="94"  <?php if($country_code=="94"){ echo "selected=selected"; } ?>>Sri Lanka (+94)</option>
                                                            <option data-countryCode="SH" value="290"  <?php if($country_code=="290"){ echo "selected=selected"; } ?>>St. Helena (+290)</option>
                                                            <option data-countryCode="KN" value="1869"  <?php if($country_code=="1869"){ echo "selected=selected"; } ?>>St. Kitts (+1869)</option>
                                                            <option data-countryCode="SC" value="1758"  <?php if($country_code=="1758"){ echo "selected=selected"; } ?>>St. Lucia (+1758)</option>
                                                            <option data-countryCode="SD" value="249"  <?php if($country_code=="249"){ echo "selected=selected"; } ?>>Sudan (+249)</option>
                                                            <option data-countryCode="SR" value="597"  <?php if($country_code=="597"){ echo "selected=selected"; } ?>>Suriname (+597)</option>
                                                            <option data-countryCode="SZ" value="268"  <?php if($country_code=="268"){ echo "selected=selected"; } ?>>Swaziland (+268)</option>
                                                            <option data-countryCode="SE" value="46"  <?php if($country_code=="46"){ echo "selected=selected"; } ?>>Sweden (+46)</option>
                                                            <option data-countryCode="CH" value="41"  <?php if($country_code=="41"){ echo "selected=selected"; } ?>>Switzerland (+41)</option>
                                                            <option data-countryCode="SI" value="963"  <?php if($country_code=="963"){ echo "selected=selected"; } ?>>Syria (+963)</option>
                                                            <option data-countryCode="TW" value="886"  <?php if($country_code=="886"){ echo "selected=selected"; } ?>>Taiwan (+886)</option>
                                                            <option data-countryCode="TJ" value="7"  <?php if($country_code=="7"){ echo "selected=selected"; } ?>>Tajikstan (+7)</option>
                                                            <option data-countryCode="TH" value="66"  <?php if($country_code=="66"){ echo "selected=selected"; } ?>>Thailand (+66)</option>
                                                            <option data-countryCode="TG" value="228"  <?php if($country_code=="228"){ echo "selected=selected"; } ?>>Togo (+228)</option>
                                                            <option data-countryCode="TO" value="676"  <?php if($country_code=="676"){ echo "selected=selected"; } ?>>Tonga (+676)</option>
                                                            <option data-countryCode="TT" value="1868"  <?php if($country_code=="1868"){ echo "selected=selected"; } ?>>Trinidad &amp; Tobago (+1868)</option>
                                                            <option data-countryCode="TN" value="216"  <?php if($country_code=="216"){ echo "selected=selected"; } ?>>Tunisia (+216)</option>
                                                            <option data-countryCode="TR" value="90"  <?php if($country_code=="90"){ echo "selected=selected"; } ?>>Turkey (+90)</option>
                                                            <option data-countryCode="TM" value="7"  <?php if($country_code=="7"){ echo "selected=selected"; } ?>>Turkmenistan (+7)</option>
                                                            <option data-countryCode="TM" value="993"  <?php if($country_code=="993"){ echo "selected=selected"; } ?>>Turkmenistan (+993)</option>
                                                            <option data-countryCode="TC" value="1649"  <?php if($country_code=="1649"){ echo "selected=selected"; } ?>>Turks &amp; Caicos Islands (+1649)</option>
                                                            <option data-countryCode="TV" value="688"  <?php if($country_code=="688"){ echo "selected=selected"; } ?>>Tuvalu (+688)</option>
                                                            <option data-countryCode="UG" value="256"  <?php if($country_code=="256"){ echo "selected=selected"; } ?>>Uganda (+256)</option>
                                                            <option data-countryCode="GB" value="44"  <?php if($country_code=="44"){ echo "selected=selected"; } ?>>UK (+44)</option>
                                                            <option data-countryCode="UA" value="380"  <?php if($country_code=="380"){ echo "selected=selected"; } ?>>Ukraine (+380)</option>
                                                            <option data-countryCode="AE" value="971"  <?php if($country_code=="971"){ echo "selected=selected"; } ?>>United Arab Emirates (+971)</option>
                                                            <option data-countryCode="UY" value="598"  <?php if($country_code=="598"){ echo "selected=selected"; } ?>>Uruguay (+598)</option>
                                                            <option data-countryCode="US" value="1"  <?php if($country_code=="1"){ echo "selected=selected"; } ?>>USA (+1)</option>
                                                            <option data-countryCode="UZ" value="7"  <?php if($country_code=="7"){ echo "selected=selected"; } ?>>Uzbekistan (+7)</option>
                                                            <option data-countryCode="VU" value="678"  <?php if($country_code=="678"){ echo "selected=selected"; } ?>>Vanuatu (+678)</option>
                                                            <option data-countryCode="VA" value="379"  <?php if($country_code=="379"){ echo "selected=selected"; } ?>>Vatican City (+379)</option>
                                                            <option data-countryCode="VE" value="58"  <?php if($country_code=="58"){ echo "selected=selected"; } ?>>Venezuela (+58)</option>
                                                            <option data-countryCode="VN" value="84"  <?php if($country_code=="84"){ echo "selected=selected"; } ?>>Vietnam (+84)</option>
                                                            <option data-countryCode="VG" value="1284"  <?php if($country_code=="1284"){ echo "selected=selected"; } ?>>Virgin Islands - British (+1284)</option>
                                                            <option data-countryCode="VI" value="1340"  <?php if($country_code=="1340"){ echo "selected=selected"; } ?>>Virgin Islands - US (+1340)</option>
                                                            <option data-countryCode="WF" value="681"  <?php if($country_code=="681"){ echo "selected=selected"; } ?>>Wallis &amp; Futuna (+681)</option>
                                                            <option data-countryCode="YE" value="969"  <?php if($country_code=="969"){ echo "selected=selected"; } ?>>Yemen (North)(+969)</option>
                                                            <option data-countryCode="YE" value="967"  <?php if($country_code=="967"){ echo "selected=selected"; } ?>>Yemen (South)(+967)</option>
                                                            <option data-countryCode="ZM" value="260"  <?php if($country_code=="260"){ echo "selected=selected"; } ?>>Zambia (+260)</option>
                                                            <option data-countryCode="ZW" value="263"   <?php if($country_code=="263"){ echo "selected=selected"; } ?>>Zimbabwe (+263)</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="phone" id="system_phone" value="<?php echo $this->db->get_where('system_setting', array('type' => 'phone'))->row()->description; ?>">
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="form-group hidden">
                                                <label  class="col-sm-3 control-label"><?php echo ucwords("Paypal Email"); ?><span style="color:red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="paypal_email" id="paypal_email" value="<?php echo $this->db->get_where('system_setting', array('type' => 'paypal_email'))->row()->description; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"><?php echo ucwords("Currency"); ?><span style="color:red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="currency" id="currency" value="<?php echo $this->db->get_where('system_setting', array('type' => 'currency'))->row()->description; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label"><?php echo ucwords("System Email"); ?><span style="color:red">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="system_email" id="system_email" value="<?php echo $this->db->get_where('system_setting', array('type' => 'system_email'))->row()->description; ?>">
                                                </div>
                                            </div>	
                                            <div class="form-group hidden">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo ucwords("Photo"); ?></label>                          
                                                <div class="col-sm-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                            <img src="<?php echo $this->Crud_model->get_image_url('system', $this->session->userdata('admin_id')); ?>" id="blah" alt="...">
                                                        </div>
                                                        <!--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>-->
                                                        <div>
                                                            <span class="btn btn-white btn-file">                                        
                                                                <input type="file" id="imgInp" name="userfile"  accept="image/*"  >
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	 	
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary"><?php echo ucwords("save"); ?></button>
                                                </div>
                                            </div>

            </div>
            <?php form_close(); ?>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->