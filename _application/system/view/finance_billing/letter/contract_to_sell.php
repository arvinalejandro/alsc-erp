<!DOCTYPE html> 
<html>

	<head>
        <link rel="stylesheet" type="text/css" href="/_application/content/css/print_global.css" />
		<link rel="stylesheet" type="text/css" href="/_application/content/css/print_legal.css" />
        <script type="text/javascript" src="/_application/content/js/jquery.js"></script>
        <script type="text/javascript" src="/_application/content/js/globals.js"></script>
        <script type="text/javascript" src="/_application/content/plugins/jquery.ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/_application/content/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/_application/content/js/letter.js"></script> 
	</head>
	<body>
	<div style="display: none;">
        <form action="/finance_billing/due/letter_submit" method="POST" name="alsc_form">
            <textarea id="_letter_content_" name="mce[account_letter_content]"></textarea>
            <input name="client_account_id" value="<?=$_VIEW['client_account_id']?>" />
            <input name="option_invoice_status_id" value="2" />
            <input name="int[client_account_id]" value="<?=$_VIEW['client_account_id']?>" />
            <input name="int[user_id]" value="<?=$_VIEW['_user_']['user_id']?>" />
            <input name="str[account_letter_type]" value="<?=$_GET['letter']?>" />
            <input name="str[account_letter_name]" value="CONTRACT TO SELL" />
        </form>
    </div>
    
	<div>
        <div id="print_controls" class="display_none">
            <div style="float:left; margin-left:20px;">
                <h3>File Name:</h3>
                <h2>Contract to Sell (CTS)</h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Client Name:</h3>
                <h2><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></h2>
            </div>
            <div style="float:left; margin-left:30px;">
                <h3>Date of Printing:</h3>
                <h2><?=string_date(time())?></h2>
            </div>
            
            <div style="float:right; margin-right:20px;">
                <span style="color:#ffffff; margin-right:20px;"><?=$_VIEW['_user_']['user_name']?> <?=$_VIEW['_user_']['user_surname']?></span>
                <button class="gray" style="margin-right:10px;" onclick="test()">Cancel</button>
                <button class="blue" onclick="window.print()"><span></span>Print</button>
            </div>
            
            <label></label>
        </div>
        
        <label id="top_pad"></label>
        
        <div id="content">
            <!-- put this to template. just in-case they will change address, etc. -->
           
            <div style="margin:0 auto;">  
                <div style="margin:0 auto; width:520px;">
                    <img src="/_application/content/images/ALSC_logo_bnw.jpg" style="margin-right:10px; float:left;" width="80px" />
                    <div style="float:left; line-height: 12pt; margin-left: 25px;">
                        <h1>ASIAN LAND STRATEGIES CORPORATION</h1>
                        <span style="font-size:12pt; font-weight:bold;">CONTRACT TO SELL (CTS)</span><br/>
                        <span style="font-size:10pt;">No: <b>1024-1234</b></span>
                    </div>
                    <label></label>
                </div>     
	                
	                
	                <p style="margin-top:20px;">
                        THIS CONTRACT TO SELL, entered into this
                        <b id="output_date_entered"><?=string_date(time())?></b> at
                        <b id="output_address_entered">Malolos City</b> by and between:
                    </p>
	                <p>ASIAN LAND STRATEGIES CORPORATION a corporation organized and existing under Philippine laws, with office and postal address at Asian Land Corporate Center, Grand Royale Subd., Bulihan, Malolos City, represented herein by its duly authorized representative, hereinafter referred to as the OWNER;</p>
	                
	                <div style="text-align:center;">-and-</div>
	                <div style="text-align:center; font-size:14pt; text-transform:uppercase;">
                        <b id="output_purchaser_name"><?=$_VIEW['client_name']?> <?=$_VIEW['client_surname']?></b>,
                    </div>
	                
	                <p>Filipino/s, of legal age, and with postal address at
                        <b id="output_purchaser_address">#82 LAGUNDI PLARIDEL BULACAN 3004</b>
                    </p>
	                <p>Hereinafter referred to as the PURCHASER, by presents;</p>
	                <div style="text-align:center;font-weight:bold;">-WITNESSETH-</div>
	                
                    <p>That for and in consideration of the sum of 
                        <b class="output_amount_word">Two Million Six Hundred Nine Thousand Four Hundred Sixty</b> PESOS ONLY 
                        (P<b class="output_amount_number">2,699,460.00</b>),
                        which the PURCHASER has bound himself to pay in the manner hereinafter specified, the OWNER has agreed and contracted to sell to the PURCHASER one (1) parcel of land situated in
                        <b id="output_land">Mojon, Malolos City</b> and included in the
                        <b id="output_include">Grand Royale 1-F</b> of which property the OWNER is the registered owner/developer in accordance with Transfer Certificate of Title No.
                        <b id="output_certificate">input data</b> of the Office of the Register of Deeds of
                        <b id="output_reg_of_deed">Bulacan</b> and which parcel of land is designated as:
                        Block <b id="output_block">001</b>
                        Lot <b id="output_lot">06</b> and which with an area of
                        <b id="output_area_word">L - One Hundred Twenty Four, H - Eighty Four</b> 
                        (<b id="output_area_number">L - 124.00, H - 84.00</b>) square meters, more or less;
                    </p>
	            
	                 <div style="text-align:center; font-weight:bold;">-THE CONDITIONS OF THIS CONTRACT TO SELL ARE AS FOLLOWS:-</div>
	                 
	                 <ol>
	                    <li>
	                        The PURCHASER hereby agrees to pay the purchase price of 
	                        <b class="output_amount_word">Two Million Six Hundred Nine Thousand Four Hundred Sixty</b>
                            (P<b class="output_amount_number">2,699,460.00</b>)
	                        at the office of the OWNER without necessity of demand for the services of a collector, in the following manner:
	                        <ol style="list-style-type:lower-alpha;">
	                            <li>
	                                <b id="output_total_dp_word">Five Hundred Thirty Nine Thousand Eight Hundred Ninety Two</b> PESOS ONLY
                                    P<b id="output_total_dp_number">539,892.00</b>)  
	                                upon the execution of this Contract as full downpayment;  
	                            </li>
	                            <li>
	                                Balance of
                                    <b id="output_balance_word">Two Million One Hundred Fifty Nine Thousand Five Hundred Sixty Eight</b> PESOS ONLY
                                    (P<b id="output_balance_number">2,159,568.00</b>) to be paid for
                                    <b id="output_balance_month">120</b> month(s) at the rate of
                                    <b id="output_balance_rate_word">Seventeen</b> (<b id="output_balance_rate_number">17.00</b>) percent per annum with an amortization of
                                    <b id="output_balance_amort_word">Thirty Seven Thousand Five Hundred Thirty Three</b> PESOS ONLY (P<b id="output_balance_amort_number">37,533.00</b>)
	                                commencing on <b id="output_balance_amort_commence">December 16, 2013</b>.                                
	                            </li>
	                        </ol>
	                    </li>
	                    <li>There shall be a surcharge of five (5) percent of the amortization due for each month in arrears, or any fraction provided that this provision shall not apply to cases where forfeitures have been affected in accordance with paragraph 14.</li>
	                    <li>
	                        The PURCHASER further agrees to pay, in addition to the purchase price and interest thereon mentioned in Section 1 hereof the following:
	                        <ol style="list-style-type:lower-alpha;">
	                            <li>Real estate taxes and assessments on the lot or unit shall be paid by the OWNER, for as long as the title has not passed to the PURCHASER; provided, however, that if the PURCHASER has actually taken possession of the occupied lot or unit, he shall be liable to the OWNER for such taxes and assessments effective the year of such taking of possession and occupancy;</li>
	                            <li>The documentary stamps and execution fees of this Contract as well those of the corresponding Deed of Absolute Sale.</li>
	                            <li>The other fees, expenses and penalties hereinafter provided when the OWNER is entitled to the same;</li>
	                        </ol>    
	                    </li>
	                 
	                    <li>Upon complete payment by the PURCHASER of all the obligations herein stipulated, the OWNER agrees to execute a final Deed of Sale in favor of the PURCHASER and cause the issuance of a Certificate of Title in the name of the latter, free from liens and encumbrances except those as maybe provided in the Land Registration Act, those imposed by the authorities and those contained in Sections 6 & 7 of this Contract, and Subdivision Regulations by the OWNER.</li>
	                    <li>The PURCHASER may be allowed to enter into and take possession of the property but his possession under this section shall only be that of a tenant or lessee subject to ejectment proceedings during the period of this Contract for breach hereof. Any improvements on lot purchases shall accrue to the OWNER upon cancellation of this Contract.</li>
                        <li>
	                        That the covered by this Contract is subject to the following restrictions which we are made integral parts hereof:
	                        <ol style="list-style-type:lower-alpha;">
	                            <li>All buildings which may be constructed anytime on the property must be maximum of 2-storey and made of strong materials, with modern sanitary installations connected to a public sewer system or to an appropriate septic tank and must further more erected with a setback reckoned from the lot lines of not less than one (1) meter on the side fronting and or abutting the street/s or proposed street/s and one (1) meter on the sides and rear of the building. Said space of one (1) meter in the sides and rear of the building shall serve as easements for water drainage and other public utilities that maybe desirable, and the PURCHASER shall permit access thereto by authorized representatives of the OWNER, public utility and/or the Association mentioned in sub-paragraph (e) hereof for the purpose of utilizing and/or making use of the easement herein created;</li>
	                            <li>Billboards, signs and other advertising media which are or may be offensive to the sight which may destroy or obstruct the view of the landscape of the general vicinity shall not be put, constructed of affixed on the property;</li>
	                            <li>Requirements of duly constituted authorities of the government which are or may be binding upon the OWNER shall be followed and complied with the PURCHASER;</li>
	                            <li>Any provision to the contrary notwithstanding, the PURCHASER shall not introduce any improvement, install any fence, wall or similar objects, excavate, fill or undertake any project without written permit from the OWNER. For this purpose, PURCHASER shall, prior to start of construction, secure from OWNER a Certificate of Construct and such shall be valid only if construction is started within thirty (30) days from date of issuance. Any building permit for the construction of a house shall be deemed to include the construction of perimeter fence if said fence is constructed within thirty (30) days from date of issuance. PURCHASER warrants and agrees that he will stand responsible for the actuation of the men he and/or his contractor will employ in the said construction, and he further warrants that the governing construction, plans specifications, bill of materials and cost estimates authenticated by a licensed architect or civil engineer shall be submitted to the OWNER for approval before any construction can be commenced or undertaken;</li>
                                <li>Upon the execution of this Contract the PURCHASER shall become member of the Lot Owners and/or Homeowners Association recognized by the OWNER under such charter and by-laws it may adopt for the general welfare of the lot owners/homeowners. When
                                    <div class="page_number">Contract to Sell - Page 1/4</div>
                                    <hr>
                                organized, said association shall have authority to prescribe rules and regulations it may deem proper for the proper management and maintenance of the subdivision. Until such time when the improvements in the subdivision shall have been donated and/or full management and ownership thereof given to the Association and/or city or Municipal Government concerned, all restrictions, easements, or provisions under this Contract cannot be modified, amended or cancelled by the Association;</li>
	                            <li>A lot may not be subdivided and maybe used for residential purposes only. No more than one single residential unit shall be constructed thereon;</li>
	                            <li>No animals shall be kept or raised on the lot other than domestic dogs, cats, or caged birds;</li>
	                            <li>The PURCHASER binds himself to construct at his own expense, a fence along the rear/right/left boundary of the herein lot, made of hollow blocks with steel reinforcement and not less than five (5) feet from the road level, with proper foundation, within a period of fifteen (15) days from written notice to such effect. Upon failure of the PURCHASER to comply with this undertakings, the OWNER may have said fence constructed at the expense of the PURCHASER in which case the cost thereof plus interest and other charges shall be reimbursed by the PURCHASER within fifteen (15) days from written notice of completion of said fence. No openings thru said fence, nor any connection or extension of community utilities, such as water and light shall be allowed thru said fence. Failure to effect such reimbursement within said period shall have the effect or noncompliance with this contract as provided for in Par. 14b hereof;</li>
	                            <li>The PURCHASER agrees and covenants to pay the sum of One Peso (P1.00) per square meter every month for the care and maintenance of the lot contracted, should the maintenance cost be more than the above stated amount, PURCHASER agrees to pay whatever be the actual cost of care and maintenance of said lot which amount shall constitute a lien on the lot. It is understood that this obligation shall last for as long as PURCHASER has not build a residential house on said lot;</li>
	                            <li>The PURCHASER bind himself to plant on the sidewalk fronting the herein lot, two (2) shade trees of such species and height and on such location as the PURCHASER may indicate within ten (10) days from written notice by the OWNER and shall likewise provide suitable landscaping for said sidewalk area;</li>
	                            <li>Should OWNER install water facilities to the herein lot, the OWNER may, at its option, charge a flat rate per lot per month, or install a water meter at the PURCHASER?S expense. Failure to pay water bills for any billing period, or two monthly amortization?s on the lot and/or house and lot, shall be sufficient cause for disconnecting water service and for this purpose, representatives of the OWNER shall have the right to enter the premises of the lot and/or house and lot without the permission or consent of PURCHASER to effect the said disconnection.</li>
	                            <li>PURCHASER agrees and covenants to abide by all the rules and regulations which OWNER may promulgate in the interests of orderly administration of the affairs of the subdivision and/or for the protection of the health and well being of the residents of the subdivision.</li>
	                            <li>The restrictions stated in this paragraph shall be annotated at the back of the Transfer Certificate of Title to be issued for the lot subject of this Contract. The term of these restrictions is for twenty (20) years from the date title is vested with the PURCHASER.</li>
	                        </ol>
	                    </li>  
                                                
	                    <li>
	                        <ol style="list-style-type:lower-alpha;">
	                            <li>The PURCHASER shall do or pay for any filling or any improvements on the land may be required by the Government or other competent authority and in case the OWNER is compelled to make such filling or improvement by reason of the inability of the PURCHASER to comply with such requirement, the latter shall reimburse the OWNER of the cost and expenses thereby incurred by the OWNER, by paying an initial payment of Fifty percent (50%) of the total cost and the balance in equal monthly installment?s for the remainder of the term of this Contract, plus interest at the same rate as the principal obligation and in the latter case this accounts shall be consolidated with that of the purchase price and the resulting account shall be considered as the new one for the purchase of the property herein before mentioned;</li>
	                            <li>Should this Contract be cancelled and terminated in accordance with paragraph(1a) hereof the filling or any other improvements made, whether totally or partially paid by the PURCHASER, as well as any improvement, introduced shall forth part of and be attached to the land and shall become the property of the OWNER without any obligation on the part of the latter to indemnify the PURCHASER for the cost of the same, the provision of Article 448 of the New Civil Code notwithstanding.</li>
	                        </ol>
	                    </li>
	                    <li>All payments herein agreed to be made by the PURCHASER shall be paid at the office of the OWNER as specified in Section 1 until fully paid, it is hereby expressly understood, that payments made to agent or real estate brokers SHALL BE UNDER THE SOLE AND EXCLUSIVE RESPONSIBILITY AND RISK OF THE PURCHASER and any and all receipts shall not be recognized by the OWNER as valid payments unless the same have been duly signed with this and issued with this by the OWNER?S duly authorized officer and/or cashier.</li>
	                    <li>Whatever the Government or any of its instrumentalities empowered by law shall cause or authorize an amendment of the subdivision plan, appropriate adjustments shall accordingly be made with the view to having the lot areas in the original plan conform to amended plan in such event, there shall be no change in the rights and obligations of the parties under the Contract except only that caused by the adjustment on the area and proportionate increase or decrease in the purchase cost computed at the same price per unit square meter.</li>
	                    <li>The PURCHASER hereby agrees that representatives of the OWNER shall have the right to enter the property at any time for the purpose of inspection, measurement, relocation, survey, laying of monuments or of necessary lines for water, gas, electric power, telephone and other public services to undertake works of whatever nature, for the general interest of the subdivision, and enforce the rules and regulations of the OWNER, and any inconvenience or disturbances thus caused shall not be a cause for the rescission of this Contract or an action for damages.</li>
	                    <li>The PURCHASER also agrees not to sell, cede, and encumber, transfer or in any other manner dispose of his rights and obligations under this Contract without the express written consent of the OWNER, and of any such sale,
                         cession, encumbrance, transfer or any other manner of disposition in violation hereof shall be deemed ipso facto void. The OWNER reserves its right, and the PURCHASER agrees to the assignment of this contract to any financial institution. The PURCHASER further agrees not to take soil or any other matter from this parcel of land or in any other lot in the subdivision , nor undertake any works inimical to the general interest of the subdivision.</li>
	                    
                        <li>If at any time before the payment of the purchase price the Government or any of its political subdivisions, instrumentalities or any public service company shall condemn or expropriate the property, the OWNER shall have the full and absolute right to deal, negotiate or resist the expropriating or condemning authority or enter into a compromise with the latter. In the event of expropriation, the PURCHASER shall be entitled to receive only his share proceeds realized from said expropriation.</li>
	                    <li>If there are two (2) or more PURCHASERS under this Contract, the obligations mentioned herein are deemed contracted by the PURCHASERS in their joint and solidary capacities.</li>
	                    <li>
	                        The provisions of the ?Realty Installment Buyers Protection Act? are hereby made an integral part of this contract; provided, however, that payment of the cash surrender value shall be effected at the office of the OWNER within five (5) days from receipt by the PURCHASER of notice to that effect; provided further, that should the PURCHASER fail to collect the cash surrender value within said period this Contract shall be considered cancelled.
	                        <br/><br/>
	                        A fee of One Thousand Pesos Only (P 1,000.00) shall be made by the PURCHASER for the notice of cancellation therein required deductible from the cash surrender value or added to the total delinquency to be paid as the case maybe.
	                        <ol style="list-style-type:lower-alpha;">
	                            <li>Should the PURCHASER fail to pay any two (2) monthly amortization as provided in Sec. 1, this Contract shall, by the mere fact of nonpayment, expire by itself and become cancelled, demand therefore and/or the necessity of judicial declaration to that effect, being hereby expressly waived and any all sums of money paid under this Contract shall be considered liquidated damages and/or become rentals on the property, and in this event the PURCHASER should be in possession of the property, becomes mere intruder of the
                                    <div class="page_number" style="margin-top:10px;">Contract to Sell - Page 2/4</div>
                                    <hr> 
                                same and maybe ejected therefrom by the means provided by law for trespassers. Upon such default, the OWNER shall be at liberty to dispose of and sell said parcel of land to any other persons in the same manner as if this Contract has never been executed or entered into.</li>
	                            <li>The breach by the PURCHASER of any of the conditions contained herein shall have the same effect as nonpayment of the installments within the meaning of the preceeding paragraph;</li>
	                            <li>In any of the above cases, the OWNER or its representatives shall have the right to enter into the property to take possession of the same and take whatever action is necessary or advisable to protect its right and interests in the property and nothing that maybe done or made by the PURCHASER shall be considered as revoking this authority or a denial thereof.</li>
	                        </ol>
	                    </li>
	                    <li>The parties hereby further agree that the road in the subdivision are made available only to the PURCHASER and members of his family who shall utilize and make use of the lot so acquired for residential purposes, and not otherwise as to gain entrance to, and/or exit from the adjoining properties that the PURCHASER shall use and be used to have access to property within, beyond, or adjoining the subdivision. Should the PURCHASER be found to have purposely purchased a lot on the subdivision to gain access to properties within, beyond or adjoining the subdivision, be it belonging to said PURCHASER or other persons, the OWNER shall have the right to cancel the Contract to Sell ex-parte, without right to reimbursement for whatever the PURCHASER has paid on account of the purchase price of the lot for breach of this Contract.</li>
	                          
                        
                        <li>The OWNER hereby retains all of the rights, title, ownership and interests over the creek/dry creek/bed of flowing water and/or such similar area adjacent to the lot subject of this Contract, including the right to quiet title thereto and/or that OWNER has title, ownership, over and/or the exclusive right to quiet title and/or claim the creek/dry creek/bed of flowing water and/or any such similar area adjacent to the said lot, and further acknowledges that this Contract does not confer on him any right to claim said adjacent area above mentioned.</li>
	                    <li>The PURCHASER agrees to pay fees set by the OWNER for the following, to wit, any true copy of contract, amendment of contract, transfer of rights, and mortgage redemption insurance and processing fee, if applicable.</li>
	                    <li>That it is expressly understood and agreed by the parties herein, that should there be any official devaluation of the Philippine Currency for any cause or reason whatsoever during the terms of this Contract, any amount unpaid on the date of such devaluation shall be raised in consonance with the devalued rate of the Philippine Currency.</li>
	                    <li>It is also expressly understood and agreed by the parties that should there be an increase in bank rate for loans and/or other financial accommodations, the rate of interest provided for in paragraph (1b) of this contract shall be considered as automatically amended to equal the increased bank interest rate, the date of said amendment to coincide with the date of said increase in interest rate.</li>
	                    <li>If the lot subject of this Contract is within the operational area granted to a franchise public utility company or enterprise, the obligation of OWNER to make available light and/or water facilities to the lot is limited to the forwarding and/or endorsing to the public utility company or enterprise the application of PURCHASER for light and/or water facilities to the said lot.</li>
	                    <li>That the PURCHASER hereby make manifest and represents that he has investigated the premises, subject matter of this contract, and found no squatters whatsoever on the same.</li>
	                    <li>That this contract, if applicable, shall be covered by the In-House financing Guarantee (IFG) at no cost to the PURCHASER, provided the PURCHASER applies for the IFG and said application is qualified and approved at the sole instance of the OWNER. The IFG guarantees full payment of the unpaid balance of this contract upon the death of the registered PURCHASER provided said PURCHASER is a natural person not over 65 years old at the end of the term of this contract and the account covered by this contract remains updated at the time of death of the PURCHASER. The death of one or more of multiple purchasers shall merit a proportionate share of the unpaid balance.</li>
	                    <li>Should the OWNER resort to the courts of justice in order to eject the PURCHASER and/or for the protection of its rights or redress of its grievances under this Contract, the PURCHASER agrees to pay to the OWNER, by way of Attorney?s fees, a reasonable sum which in no case shall be less than Five Thousand Pesos (P5,000.00) if the case is in or reaches the Court of First Instance, and a further sum of Twenty Thousand Pesos (P20,000.00) if it reaches any of the Appellate Courts and in addition, the cost and expenses of litigation and the damages, actual or consequantial, to which the OWNER maybe entitled by law. Nothing in this section shall be construed as in any way qualifying Sections 14 & 15 hereof.</li>
	                    <li>The PURCHASER hereby represent that this entire Contract has been read and/or translated to him in a language or dialect known and understood by him.</li>                        
                        <li>All notices and correspondence of any nature sent to the PURCHASER at the above address shall bind him, unless written notice of change of address has been received by the OWNER.</li>
	                    <li>In case of loss of PURCHASER?S copy of this Contract, the PURCHASER must immediately notify the OWNER in writing. The OWNER shall not in any way be liable for damages arising out of the use of such lost Contract.</li>
	                    <li>This Contract cancels and supersedes all previous Contracts between the parties herein and this shall not be considered as changed, modified, altered or in any way amended by acts of tolerance of the OWNER unless such changes, modifications, alterations or amendments are made in writing and signed by both parties to this.</li>
	                 </ol> 
	                 <p>IN WITNESS WHEREOF, the PURCHASER has caused his name to be affixed to this interment and has hereunto signed these presents, and the OWNER has caused its duly authorized representative to sign in its behalf, on the date and at the place herein above mentioned.</p>
	                 
	                 <table border="0" cellpadding="2" cellspacing="0" width="80%" style="margin:0 auto;">
                        <tr>
                            <td align="center" width="40%"><div style="border-top:1px solid black; padding-top:3px; margin-top:40px; font-size:8pt;">Purchaser</div></td>
                            <td rowspan="2" valign="top" align="center">
                                <div style="border-top:1px solid black; padding-top:3px; margin-top:40px; width:65%;">
                                    AMANDO M. BUHAIN<br/>
                                    President<br/>
                                    <span style="font-size:8pt">ASIAN LAND STRATEGIES CORPORATION</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><div style="border-top:1px solid black; padding-top:3px; margin-top:40px; font-size:8pt;">Purchaser</div></td>
                        </tr>
	                 </table>
                     
                     <table border="0" cellpadding="2" cellspacing="0" width="80%" style="margin:40px auto 0 auto;">
                        <tr align="center">
                            <td colspan="2">SIGNED IN THE PRESENCE OF :</td>
                        </tr>
                        <tr align="center">
                            <td><div style="border-top:1px solid black; padding-top:3px; margin:30px auto 30px auto; width:80%;"></div></td>
                            <td><div style="border-top:1px solid black; padding-top:3px; margin:30px auto 30px auto; width:80%;"></div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Reviewed by<br/>Date</td>
                        </tr>
                     </table>
                     
                     <div class="page_number" style="margin:40px 0 50px 0;">Contract to Sell - Page 3/4</div>
                     <hr>
                     
                     
                    <div style="text-align:center; font-weight:bold; padding-top:20px;">A C K N O W L E D G E M E N T</div>
                    <p style="font-weight:bold;">REPUBLIC OF THE PHILIPPINES) <br/>
                    MALOLOS CITY <span style="margin-left:100px;"> ) S.S.</span>
                    </p>
                    <p>BEFORE ME, a Notary Public for and in Malolos City appeared AMANDO M. BUHAIN with Unified Multi-Purpose ID No. CRN-0003-0691881-2 in his capacity as President of Asian Land Strategies Corporation and :</p>

                    <table border="0" cellpadding="5" cellspacing="0" style="margin:40px auto 40px auto; padding:10px; border:1px solid black; border-radius:5px;">
                        <tr>
                            <td>Name</td>
                            <td width="20px"></td>
                            <td>Competent Proof of Identity</td>
                        </tr>
                        <tr>
                            <td><b id="output_ack_name1">Amando M. Buhain</b></td>
                            <td></td>
                            <td><b id="output_ack_id1">SSS ID No: 03-0691881-2</b></td>
                        </tr>
                        <tr>
                            <td><b id="output_ack_name2">Annalizza Coronel</b></td>
                            <td></td>
                            <td><b id="output_ack_id2">Driver's License D04-08-010500</b></td>
                        </tr>
                    </table>
                    <p>all known to me to be the same persons who executed the foregoing Contract to Sell consisting of four (4) pages, and signed by the parties and their instrumental witnesses on the left hand margin of each and every page thereof.</p>
                    <p>This instrument refers to the sale of one (1) parcel of land and the parties hereby acknowledged that the same is their free act and deed.</p>
                    <div style="text-align:center; font-weight:bold; margin-bottom:200px;">WITNESS MY HAND AND NOTARIAL SEAL.</div>
                    
                    <table border="0" cellpadding="5" cellspacing="0" width="50%" style="float:left; margin-bottom:200px;">
                        <tr valign="bottom">
                            <td width="20%">Doc No</td>
                            <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                        </tr>
                        <tr valign="bottom">
                            <td width="20%">Page No</td>
                            <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                        </tr>
                        <tr valign="bottom">
                            <td width="20%">Book No</td>
                            <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                        </tr>
                        <tr valign="bottom">
                            <td width="20%">Series of</td>
                            <td><div style="border-top:1px solid black; padding-top:3px; margin-top:15px; width:80%;"></div></td>
                        </tr>
                    </table>
                    <label></label>
                    <div class="page_number">Contract to Sell - Page 4/4</div>
                </div>
            </div>
            <div id="input_controls" class="display_none hidden">
            <div id="input_hider">
                <button id="hide_button" class="blue none" onclick="hide()">Hide</button>
                <button id="unhide_button" class="blue" onclick="unhide()">Show</button>
            </div>
            <div id="scroller">
                <div id="input_body">
                    <table width="100%" cellpadding="10" cellspacing="0" border="0" class="border">
                        <tr>
                            <td colspan="4" align="center" style="background-color:gray; font-weight:bold;">INTRODUCTION</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span>Date Entered</span>
                                <input type="text" value="<?=string_date(time())?>" id="input_date_entered" onkeyup="type_date_entered()" />
                            </td>
                            <td>
                                <span>Address Entered</span>
                                <input type="text" value="Malolos City" id="input_address_entered" onkeyup="type_address_entered()" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span>Purchaser's Full Name</span>
                                <input type="text" value="ANA LIZZA G. CORONEL MARRIED TO CORNELIO CORONEL" id="input_purchaser_name" onkeyup="type_purchaser_name()" />
                            </td>
                            <td>
                                <span>Purchaser's Address</span>
                                <input type="text" value="#82 LAGUNDI PLARIDEL BULACAN 3004" id="input_purchaser_address" onkeyup="type_purchaser_address()" />
                            </td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center" style="background-color:gray; font-weight:bold;">WITNESSETH</td>
                        </tr>
                        
                        <tr>
                            <td>
                                <span>Sum (in words)</span>
                                <input type="text" value="Two Million Six Hundred Nine Thousand Four Hundred Sixty" id="input_amount_word" onkeyup="type_amount_word()" />
                            </td>
                            <td>
                                <span>Sum (in numbers)</span>
                                <input type="text" value="2,699,460.00" id="input_amount_number" onkeyup="type_amount_number()" />
                            </td>
                            <td>
                                <span>Land</span>
                                <input type="text" value="Mojon, Malolos City" id="input_land" onkeyup="type_land()" />
                            </td>
                            <td>
                                <span>Included in</span>
                                <input type="text" value="Grand Royale 1-F" id="input_include" onkeyup="type_include()" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span>Transfer Certificate of Title No.</span>
                                <input type="text" value="" id="input_certificate" onkeyup="type_certificate()" />
                            </td>
                            <td>
                                <span>Purchaser's Address</span>
                                <input type="text" value="Bulacan" id="input_reg_of_deed" onkeyup="type_reg_of_deed()" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Block</span>
                                <input type="text" value="001" id="input_block" onkeyup="type_block()" />
                            </td>
                            <td>
                                <span>Lot</span>
                                <input type="text" value="06" id="input_lot" onkeyup="type_lot()" />
                            </td>
                            <td>
                                <span>Area (sqm) in words</span>
                                <input type="text" value="L - One Hundred Twenty Four, H - Eighty Four" id="input_area_word" onkeyup="type_area_word()" />
                            </td>
                            <td>
                                <span>Area (sqm) in numbers</span>
                                <input type="text" value="L - 124.00, H - 84.00" id="input_area_number" onkeyup="type_area_number()" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center" style="background-color:gray; font-weight:bold;">THE CONDITIONS OF THIS CONTRACT TO SELL</td>
                        </tr>
                        <tr>
                            <td>
                                <span>Full Downpayment (in words)</span>
                                <input type="text" value="Five Hundred Thirty Nine Thousand Eight Hundred Ninety Two" id="input_total_dp_word" onkeyup="type_total_dp_word()" />
                            </td>
                            <td>
                                <span>Full Downpayment (in numbers)</span>
                                <input type="text" value="539,892.00" id="input_total_dp_number" onkeyup="type_total_dp_number()" />
                            </td>
                            <td>
                                <span>Balance (in words)</span>
                                <input type="text" value="L - One Hundred Twenty Four, H - Eighty Four" id="input_balance_word" onkeyup="type_balance_word()" />
                            </td>
                            <td>
                                <span>Balance (in numbers)</span>
                                <input type="text" value="L - 124.00, H - 84.00" id="input_balance_number" onkeyup="type_balance_number()" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Terms (in months)</span>
                                <input type="text" value="120" id="input_balance_month" onkeyup="type_balance_month()" />
                            </td>
                            <td>
                                <span>Rate (in words)</span>
                                <input type="text" value="Seventeen" id="input_balance_rate_word" onkeyup="type_balance_rate_word()" />
                            </td>
                            <td>
                                <span>Rate (in numbers)</span>
                                <input type="text" value="17.00" id="input_balance_rate_number" onkeyup="type_balance_rate_number()" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Amortization (in words)</span>
                                <input type="text" value="Thirty Seven Thousand Five Hundred Thirty Three" id="input_balance_amort_word" onkeyup="type_balance_amort_word()" />
                            </td>
                            <td>
                                <span>Amortization (in numbers)</span>
                                <input type="text" value="37,533.00" id="input_balance_amort_number" onkeyup="type_balance_amort_number()" />
                            </td>
                            <td>
                                <span>Commencing on</span>
                                <input type="text" value="December 16, 2013" id="input_balance_amort_commence" onkeyup="type_balance_amort_commence()" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center" style="background-color:gray; font-weight:bold;">ACKNOWLEDGEMENT</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span>Name 1</span>
                                <input type="text" value="Amando M. Buhain" id="input_ack_name1" onkeyup="type_ack_name1()" />
                            </td>
                            <td>
                                <span>Proof of Identity 1</span>
                                <input type="text" value="SSS ID No: 03-0691881-2" id="input_ack_id1" onkeyup="type_ack_id1()" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span>Name 2</span>
                                <input type="text" value="Annalizza Coronel" id="input_ack_name2" onkeyup="type_ack_name2()" />
                            </td>
                            <td>
                                <span>Proof of Identity 2</span>
                                <input type="text" value="Driver's License D04-08-010500" id="input_ack_id2" onkeyup="type_ack_id2()" />
                            </td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center"><button class="blue" onclick="save_execute()">Save</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>           
        <script type="text/javascript">
            function hide()
            {
                $('#hide_button').addClass('none');    
                $('#unhide_button').removeClass('none'); 
                $('#input_controls').addClass('hidden'); 
                $('#content').css({"padding": "40px 80px 80px 50px"});                 
            }
            
            function unhide()
            {
                $('#hide_button').removeClass('none');    
                $('#unhide_button').addClass('none'); 
                $('#input_controls').removeClass('hidden'); 
                $('#content').css({"padding": "40px 80px 270px 50px"});  
            }
            
            function type_date_entered()
            {
                value_date_entered = $('#input_date_entered').val();
                $('#output_date_entered').html(value_date_entered);
            } 
            
            function type_purchaser_name()
            {
                value_purchaser_name = $('#input_purchaser_name').val();
                $('#output_purchaser_name').html(value_purchaser_name);
            }
            
            function type_purchaser_address()
            {
                value_purchaser_address = $('#input_purchaser_address').val();
                $('#output_purchaser_address').html(value_purchaser_address);
            }
            
            function type_amount_word()
            {
                value_amount_word = $('#input_amount_word').val();
                $('.output_amount_word').html(value_amount_word);
            }
            
            function type_amount_number()
            {
                value_amount_number = $('#input_amount_number').val();
                $('.output_amount_number').html(value_amount_number);
            }
            
            function type_land()
            {
                value_land = $('#input_land').val();
                $('#output_land').html(value_land);
            }
            
            function type_include()
            {
                value_include = $('#input_include').val();
                $('#output_include').html(value_include);
            }
            
            function type_certificate()
            {
                value_certificate = $('#input_certificate').val();
                $('#output_certificate').html(value_certificate);
            }
            
            function type_reg_of_deed()
            {
                value_reg_of_deed = $('#input_reg_of_deed').val();
                $('#output_reg_of_deed').html(value_reg_of_deed);
            }
            
            function type_block()
            {
                value_block = $('#input_block').val();
                $('#output_block').html(value_block);
            }
            
            function type_lot()
            {
                value_lot = $('#input_lot').val();
                $('#output_lot').html(value_lot);
            }
            
            function type_area_word()
            {
                value_area_word = $('#input_area_word').val();
                $('#output_area_word').html(value_area_word);
            }
            
            function type_area_number()
            {
                value_area_number = $('#input_area_number').val();
                $('#output_area_number').html(value_area_number);
            }
            
            function type_total_dp_word()
            {
                value_total_dp_word = $('#input_total_dp_word').val();
                $('#output_total_dp_word').html(value_total_dp_word);
            }
            
            function type_total_dp_number()
            {
                value_total_dp_number = $('#input_total_dp_number').val();
                $('#output_total_dp_number').html(value_total_dp_number);
            }
            
            function type_balance_word()
            {
                value_balance_word = $('#input_balance_word').val();
                $('#output_balance_word').html(value_balance_word);
            }
            
            function type_balance_number()
            {
                value_balance_number = $('#input_balance_number').val();
                $('#output_balance_number').html(value_balance_number);
            }
            
            function type_balance_month()
            {
                value_balance_month = $('#input_balance_month').val();
                $('#output_balance_month').html(value_balance_month);
            }
            
            function type_balance_rate_word()
            {
                value_balance_rate_word = $('#input_balance_rate_word').val();
                $('#output_balance_rate_word').html(value_balance_rate_word);
            }
            
            function type_balance_rate_number()
            {
                value_balance_rate_number = $('#input_balance_rate_number').val();
                $('#output_balance_rate_number').html(value_balance_rate_number);
            }
            
            function type_balance_amort_word()
            {
                value_balance_amort_word = $('#input_balance_amort_word').val();
                $('#output_balance_amort_word').html(value_balance_amort_word);
            }
            
            function type_balance_amort_number()
            {
                value_balance_amort_number = $('#input_balance_amort_number').val();
                $('#output_balance_amort_number').html(value_balance_amort_number);
            }
            
            function type_balance_amort_commence()
            {
                value_balance_amort_commence = $('#input_balance_amort_commence').val();
                $('#output_balance_amort_commence').html(value_balance_amort_commence);
            }
            
            function type_ack_name1()
            {
                value_ack_name1 = $('#input_ack_name1').val();
                $('#output_ack_name1').html(value_ack_name1);
            }
            
            function type_ack_id1()
            {
                value_ack_id1 = $('#input_ack_id1').val();
                $('#output_ack_id1').html(value_ack_id1);
            }
            
            function type_ack_name2()
            {
                value_ack_name2 = $('#input_ack_name2').val();
                $('#output_ack_name2').html(value_ack_name2);
            }
            
            function type_ack_id2()
            {
                value_ack_id2 = $('#input_ack_id2').val();
                $('#output_ack_id2').html(value_ack_id2);
            }
        </script>         
                    
                 
        </div>        
	</body>
	
</html>

<!--<script type="text/javascript">

	var vCount	=	1;
	function test()
	{
		
		$('._page_').each(function(){
		
			$(this).find('._pnum').html('Page ' + vCount);
			vCount++;
		
		
		});
	}
	
	
	
</script>  -->







