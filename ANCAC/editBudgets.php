<?PHP
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");
        //set the fiscalYear
        switch (date("m")){
                case 10:
                        $fiscalYear = date("Y") + 1;
                        if (date("j") < 11)
                                $EOYAvailable = 1;
                        else
                                $EOYAvailable = 0;
                        break;
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $EOYAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
        }
        $CY = 0;
        //set the center that is being edited for
        if($_SESSION['admin'] > 0){
                //Center
                if (isset($_GET['center'])){
                        $centerID = $_GET['center'];
                }
                if (isset($_GET['Y'])){
                        if ($_GET['Y'] == 1){
                                $fiscalYear = $fiscalYear - 1;
                                $CY = 1;
                        }
                }
                $EOYAvailable = 1;
        }
        else{
                //center
                if (isset($_SESSION['center'])){
                        $centerID = $_SESSION['center'];
                }
        }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$centerID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Editing Budgets for '.$CenterName;
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

?>

<body>
<table class='OutlineTable' align=center width="95%">
<tr>
	<td class='login-header' colspan='2' align=center><?PHP echo $CenterName; ?> Editing Budgets - FY <?PHP echo $fiscalYear; ?><br></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
			<form action="updateBudgets.php" method="post">
			<?PHP //grab the budgeted information to display
			     $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 1";

                             $result = @mysql_query($sql) or mysql_error();
                             $row1QBudgeted = mysql_fetch_object($result);
                             $Update1 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 2";

                             $result = @mysql_query($sql) or mysql_error();
                             $row2QBudgeted = mysql_fetch_object($result);
                             $Update2 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 3";

                             $result = @mysql_query($sql) or mysql_error();
                             $row3QBudgeted = mysql_fetch_object($result);
                             $Update3 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 4";

                             $result = @mysql_query($sql) or mysql_error();
                             $row4QBudgeted = mysql_fetch_object($result);
                             $Update4 = mysql_num_rows($result);

                             $ExpenseBud1 = array();
                             $ExpenseBud2 = array();
                             $ExpenseBud3 = array();
                             $ExpenseBud4 = array();

                        ?>

                <table width="100%" class="Admin">
                <tr>
                        <td width="40%"><b>Performance Statistics</td>
                        <td align="center"><b>Quarter ending Dec 31</b></td>
                        <td align="center"><b>Quarter ending Mar 31</b></td>
                        <td align="center"><b>Quarter ending Jun 31</b></td>
                        <td align="center"><b>Quarter ending Sep 31</b></td>
                </tr>
                <tr align="center">
                        <td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal1"
                                value="<?PHP if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal2"
                                value="<?PHP if(isset($row2QBudgeted->fiTotal)) echo $row2QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal3"
                                value="<?PHP if(isset($row3QBudgeted->fiTotal)) echo $row3QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal4"
                                value="<?PHP if(isset($row4QBudgeted->fiTotal)) echo $row4QBudgeted->fiTotal; ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval1"
                                value="<?PHP if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval2"
                                value="<?PHP if(isset($row2QBudgeted->extForenEval)) echo $row2QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval3"
                                value="<?PHP if(isset($row3QBudgeted->extForenEval)) echo $row3QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval4"
                                value="<?PHP if(isset($row4QBudgeted->extForenEval)) echo $row4QBudgeted->extForenEval; ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes1"
                                value="<?PHP if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes2"
                                value="<?PHP if(isset($row2QBudgeted->intCounsSes)) echo $row2QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes3"
                                value="<?PHP if(isset($row3QBudgeted->intCounsSes)) echo $row3QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes4"
                                value="<?PHP if(isset($row4QBudgeted->intCounsSes)) echo $row4QBudgeted->intCounsSes; ?>" /></td>
                </tr>
                <tr>
                        <td colspan="5"><br></td>
                </tr>
                <tr>
                        <td><b>Quarterly Expenditures</td>
                        <td align="center"><b>Quarter ending Dec 31</b></td>
                        <td align="center"><b>Quarter ending Mar 31</b></td>
                        <td align="center"><b>Quarter ending Jun 31</b></td>
                        <td align="center"><b>Quarter ending Sep 31</b></td>
                </tr>
                <tr align="center">
                        <td align="left">Personnel Costs</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="personnelCosts1"
                                value="<?PHP if(isset($row1QBudgeted->personnelCosts)){ echo $row1QBudgeted->personnelCosts; $ExpenseBud1[] = $row1QBudgeted->personnelCosts;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="personnelCosts2"
                                value="<?PHP if(isset($row2QBudgeted->personnelCosts)){ echo $row2QBudgeted->personnelCosts; $ExpenseBud2[] = $row2QBudgeted->personnelCosts;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="personnelCosts3"
                                value="<?PHP if(isset($row3QBudgeted->personnelCosts)){ echo $row3QBudgeted->personnelCosts; $ExpenseBud3[] = $row3QBudgeted->personnelCosts;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="personnelCosts4"
                                value="<?PHP if(isset($row4QBudgeted->personnelCosts)){ echo $row4QBudgeted->personnelCosts; $ExpenseBud4[] = $row4QBudgeted->personnelCosts;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Employee Benefits</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="empBenefits1"
                                value="<?PHP if(isset($row1QBudgeted->empBenefits)){ echo $row1QBudgeted->empBenefits; $ExpenseBud1[] = $row1QBudgeted->empBenefits;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="empBenefits2"
                                value="<?PHP if(isset($row2QBudgeted->empBenefits)){ echo $row2QBudgeted->empBenefits; $ExpenseBud2[] = $row2QBudgeted->empBenefits;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="empBenefits3"
                                value="<?PHP if(isset($row3QBudgeted->empBenefits)){ echo $row3QBudgeted->empBenefits; $ExpenseBud3[] = $row3QBudgeted->empBenefits;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="empBenefits4"
                                value="<?PHP if(isset($row4QBudgeted->empBenefits)){ echo $row4QBudgeted->empBenefits; $ExpenseBud4[] = $row4QBudgeted->empBenefits;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Travel-In-State</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelInState1"
                                value="<?PHP if(isset($row1QBudgeted->travelInState)){ echo $row1QBudgeted->travelInState; $ExpenseBud1[] = $row1QBudgeted->travelInState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelInState2"
                                value="<?PHP if(isset($row2QBudgeted->travelInState)){ echo $row2QBudgeted->travelInState; $ExpenseBud2[] = $row2QBudgeted->travelInState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelInState3"
                                value="<?PHP if(isset($row3QBudgeted->travelInState)){ echo $row3QBudgeted->travelInState; $ExpenseBud3[] = $row3QBudgeted->travelInState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelInState4"
                                value="<?PHP if(isset($row4QBudgeted->travelInState)){ echo $row4QBudgeted->travelInState; $ExpenseBud4[] = $row4QBudgeted->travelInState;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Travel-Out-of-State</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelOutState1"
                                value="<?PHP if(isset($row1QBudgeted->travelOutState)){ echo $row1QBudgeted->travelOutState; $ExpenseBud1[] = $row1QBudgeted->travelOutState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelOutState2"
                                value="<?PHP if(isset($row2QBudgeted->travelOutState)){ echo $row2QBudgeted->travelOutState; $ExpenseBud2[] = $row2QBudgeted->travelOutState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelOutState3"
                                value="<?PHP if(isset($row3QBudgeted->travelOutState)){ echo $row3QBudgeted->travelOutState; $ExpenseBud3[] = $row3QBudgeted->travelOutState;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelOutState4"
                                value="<?PHP if(isset($row4QBudgeted->travelOutState)){ echo $row4QBudgeted->travelOutState; $ExpenseBud4[] = $row4QBudgeted->travelOutState;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Repairs and Maintenance</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="repairsAndMx1"
                                value="<?PHP if(isset($row1QBudgeted->repairsAndMx)){ echo $row1QBudgeted->repairsAndMx; $ExpenseBud1[] = $row1QBudgeted->repairsAndMx;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="repairsAndMx2"
                                value="<?PHP if(isset($row2QBudgeted->repairsAndMx)){ echo $row2QBudgeted->repairsAndMx; $ExpenseBud2[] = $row2QBudgeted->repairsAndMx;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="repairsAndMx3"
                                value="<?PHP if(isset($row3QBudgeted->repairsAndMx)){ echo $row3QBudgeted->repairsAndMx; $ExpenseBud3[] = $row3QBudgeted->repairsAndMx;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="repairsAndMx4"
                                value="<?PHP if(isset($row4QBudgeted->repairsAndMx)){ echo $row4QBudgeted->repairsAndMx; $ExpenseBud4[] = $row4QBudgeted->repairsAndMx;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Rentals and Leases</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="rentalsLease1"
                                value="<?PHP if(isset($row1QBudgeted->rentalsLease)){ echo $row1QBudgeted->rentalsLease; $ExpenseBud1[] = $row1QBudgeted->rentalsLease;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="rentalsLease2"
                                value="<?PHP if(isset($row2QBudgeted->rentalsLease)){ echo $row2QBudgeted->rentalsLease; $ExpenseBud2[] = $row2QBudgeted->rentalsLease;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="rentalsLease3"
                                value="<?PHP if(isset($row3QBudgeted->rentalsLease)){ echo $row3QBudgeted->rentalsLease; $ExpenseBud3[] = $row3QBudgeted->rentalsLease;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="rentalsLease4"
                                value="<?PHP if(isset($row4QBudgeted->rentalsLease)){ echo $row4QBudgeted->rentalsLease; $ExpenseBud4[] = $row4QBudgeted->rentalsLease;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Utilities and Communications</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="utilComm1"
                                value="<?PHP if(isset($row1QBudgeted->utilComm)){ echo $row1QBudgeted->utilComm; $ExpenseBud1[] = $row1QBudgeted->utilComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="utilComm2"
                                value="<?PHP if(isset($row2QBudgeted->utilComm)){ echo $row2QBudgeted->utilComm; $ExpenseBud2[] = $row2QBudgeted->utilComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="utilComm3"
                                value="<?PHP if(isset($row3QBudgeted->utilComm)){ echo $row3QBudgeted->utilComm; $ExpenseBud3[] = $row3QBudgeted->utilComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="utilComm4"
                                value="<?PHP if(isset($row4QBudgeted->utilComm)){ echo $row4QBudgeted->utilComm; $ExpenseBud4[] = $row4QBudgeted->utilComm;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Professional Services</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="profServ1"
                                value="<?PHP if(isset($row1QBudgeted->profServ)){ echo $row1QBudgeted->profServ; $ExpenseBud1[] = $row1QBudgeted->profServ;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="profServ2"
                                value="<?PHP if(isset($row2QBudgeted->profServ)){ echo $row2QBudgeted->profServ; $ExpenseBud2[] = $row2QBudgeted->profServ;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="profServ3"
                                value="<?PHP if(isset($row3QBudgeted->profServ)){ echo $row3QBudgeted->profServ; $ExpenseBud3[] = $row3QBudgeted->profServ;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="profServ4"
                                value="<?PHP if(isset($row4QBudgeted->profServ)){ echo $row4QBudgeted->profServ; $ExpenseBud4[] = $row4QBudgeted->profServ;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Supplies, Materials, Operations</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="suppMatOper1"
                                value="<?PHP if(isset($row1QBudgeted->suppMatOper)){ echo $row1QBudgeted->suppMatOper; $ExpenseBud1[] = $row1QBudgeted->suppMatOper;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="suppMatOper2"
                                value="<?PHP if(isset($row2QBudgeted->suppMatOper)){ echo $row2QBudgeted->suppMatOper; $ExpenseBud2[] = $row2QBudgeted->suppMatOper;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="suppMatOper3"
                                value="<?PHP if(isset($row3QBudgeted->suppMatOper)){ echo $row3QBudgeted->suppMatOper; $ExpenseBud3[] = $row3QBudgeted->suppMatOper;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="suppMatOper4"
                                value="<?PHP if(isset($row4QBudgeted->suppMatOper)){ echo $row4QBudgeted->suppMatOper; $ExpenseBud4[] = $row4QBudgeted->suppMatOper;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Transportation Equip. Purchases</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="tranEqpPurch1"
                                value="<?PHP if(isset($row1QBudgeted->tranEqpPurch)){ echo $row1QBudgeted->tranEqpPurch; $ExpenseBud1[] = $row1QBudgeted->tranEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="tranEqpPurch2"
                                value="<?PHP if(isset($row2QBudgeted->tranEqpPurch)){ echo $row2QBudgeted->tranEqpPurch; $ExpenseBud2[] = $row2QBudgeted->tranEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="tranEqpPurch3"
                                value="<?PHP if(isset($row3QBudgeted->tranEqpPurch)){ echo $row3QBudgeted->tranEqpPurch; $ExpenseBud3[] = $row3QBudgeted->tranEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="tranEqpPurch4"
                                value="<?PHP if(isset($row4QBudgeted->tranEqpPurch)){ echo $row4QBudgeted->tranEqpPurch; $ExpenseBud4[] = $row4QBudgeted->tranEqpPurch;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Other Equipment Purchases</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="otherEqpPurch1"
                                value="<?PHP if(isset($row1QBudgeted->otherEqpPurch)){ echo $row1QBudgeted->otherEqpPurch; $ExpenseBud1[] = $row1QBudgeted->otherEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="otherEqpPurch2"
                                value="<?PHP if(isset($row2QBudgeted->otherEqpPurch)){ echo $row2QBudgeted->otherEqpPurch; $ExpenseBud2[] = $row2QBudgeted->otherEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="otherEqpPurch3"
                                value="<?PHP if(isset($row3QBudgeted->otherEqpPurch)){ echo $row3QBudgeted->otherEqpPurch; $ExpenseBud3[] = $row3QBudgeted->otherEqpPurch;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="otherEqpPurch4"
                                value="<?PHP if(isset($row4QBudgeted->otherEqpPurch)){ echo $row4QBudgeted->otherEqpPurch; $ExpenseBud4[] = $row4QBudgeted->otherEqpPurch;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Capital Outlay</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="capOutlay1"
                                value="<?PHP if(isset($row1QBudgeted->capOutlay)){ echo $row1QBudgeted->capOutlay; $ExpenseBud1[] = $row1QBudgeted->capOutlay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="capOutlay2"
                                value="<?PHP if(isset($row2QBudgeted->capOutlay)){ echo $row2QBudgeted->capOutlay; $ExpenseBud2[] = $row2QBudgeted->capOutlay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="capOutlay3"
                                value="<?PHP if(isset($row3QBudgeted->capOutlay)){ echo $row3QBudgeted->capOutlay; $ExpenseBud3[] = $row3QBudgeted->capOutlay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="capOutlay4"
                                value="<?PHP if(isset($row4QBudgeted->capOutlay)){ echo $row4QBudgeted->capOutlay; $ExpenseBud4[] = $row4QBudgeted->capOutlay;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Debt Service</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="debtService1"
                                value="<?PHP if(isset($row1QBudgeted->debtService)){ echo $row1QBudgeted->debtService; $ExpenseBud1[] = $row1QBudgeted->debtService;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="debtService2"
                                value="<?PHP if(isset($row2QBudgeted->debtService)){ echo $row2QBudgeted->debtService; $ExpenseBud2[] = $row2QBudgeted->debtService;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="debtService3"
                                value="<?PHP if(isset($row3QBudgeted->debtService)){ echo $row3QBudgeted->debtService; $ExpenseBud3[] = $row3QBudgeted->debtService;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="debtService4"
                                value="<?PHP if(isset($row4QBudgeted->debtService)){ echo $row4QBudgeted->debtService; $ExpenseBud4[] = $row4QBudgeted->debtService;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Miscellaneous</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="misc1"
                                value="<?PHP if(isset($row1QBudgeted->misc)){ echo $row1QBudgeted->misc; $ExpenseBud1[] = $row1QBudgeted->misc;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="misc2"
                                value="<?PHP if(isset($row2QBudgeted->misc)){ echo $row2QBudgeted->misc; $ExpenseBud2[] = $row2QBudgeted->misc;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="misc3"
                                value="<?PHP if(isset($row3QBudgeted->misc)){ echo $row3QBudgeted->misc; $ExpenseBud3[] = $row3QBudgeted->misc;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="misc4"
                                value="<?PHP if(isset($row4QBudgeted->misc)){ echo $row4QBudgeted->misc; $ExpenseBud4[] = $row4QBudgeted->misc;} ?>" /></td>
                </tr>
                <?PHP
                        //check to see if they have any other expenses entered
                        $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
                        $resultOE = @mysql_query($sqlOE) or mysql_error();

                        $numRecords = mysql_num_rows($resultOE);
                        if ($numRecords > 0){
                                while ($row = mysql_fetch_object($resultOE)) {
                                echo '<tr align="center"><td align="left">'.$row->ExpenseName.'</td>';
                                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OE1Q'.$row->OExpenseID.'"
                                value="';
                                if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud1[] = $rowOEValues->oeValue;}
                                echo '" /></td>';
                                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OE2Q'.$row->OExpenseID.'"
                                value="';
                                if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud2[] = $rowOEValues->oeValue;}
                                echo '" /></td>';
                                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OE3Q'.$row->OExpenseID.'"
                                value="';
                                if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud3[] = $rowOEValues->oeValue;}
                                echo '" /></td>';
                                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OE4Q'.$row->OExpenseID.'"
                                value="';
                                if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud4[] = $rowOEValues->oeValue;}
                                echo '" /></td>';
                                echo '</tr>';
                                }
                        }
                ?>
                <!--
                <tr align="center">
                        <td align="center"><b>Total Expenditures</b></td>
                        <td align="right"><b><?PHP $totExpendsBudget = 0;
                                foreach ($ExpenseBud1 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totExpendsBudget = 0;
                                foreach ($ExpenseBud2 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totExpendsBudget = 0;
                                foreach ($ExpenseBud3 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totExpendsBudget = 0;
                                foreach ($ExpenseBud4 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                </tr>
                -->
                <tr><td colspan="13"><br></td></tr>
                <tr>
                        <td><b>Source of Funds</td>
                        <td align="center"><b>Quarter ending Dec 31</b></td>
                        <td align="center"><b>Quarter ending Mar 31</b></td>
                        <td align="center"><b>Quarter ending Jun 31</b></td>
                        <td align="center"><b>Quarter ending Sep 31</b></td>
                </tr>
                <tr align="center">
                        <td align="left">State of AL General Fund</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="genFund1"
                                value="<?PHP if(isset($row1QBudgeted->genFund)){ echo $row1QBudgeted->genFund; $FundsBud1[] = $row1QBudgeted->genFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="genFund2"
                                value="<?PHP if(isset($row2QBudgeted->genFund)){ echo $row2QBudgeted->genFund; $FundsBud2[] = $row2QBudgeted->genFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="genFund3"
                                value="<?PHP if(isset($row3QBudgeted->genFund)){ echo $row3QBudgeted->genFund; $FundsBud3[] = $row3QBudgeted->genFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="genFund4"
                                value="<?PHP if(isset($row4QBudgeted->genFund)){ echo $row4QBudgeted->genFund; $FundsBud4[] = $row4QBudgeted->genFund;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">State of AL Children First Trust</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilFirstTrust1"
                                value="<?PHP if(isset($row1QBudgeted->chilFirstTrust)){ echo $row1QBudgeted->chilFirstTrust; $FundsBud1[] = $row1QBudgeted->chilFirstTrust;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilFirstTrust2"
                                value="<?PHP if(isset($row2QBudgeted->chilFirstTrust)){ echo $row2QBudgeted->chilFirstTrust; $FundsBud2[] = $row2QBudgeted->chilFirstTrust;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilFirstTrust3"
                                value="<?PHP if(isset($row3QBudgeted->chilFirstTrust)){ echo $row3QBudgeted->chilFirstTrust; $FundsBud3[] = $row3QBudgeted->chilFirstTrust;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilFirstTrust4"
                                value="<?PHP if(isset($row4QBudgeted->chilFirstTrust)){ echo $row4QBudgeted->chilFirstTrust; $FundsBud4[] = $row4QBudgeted->chilFirstTrust;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">United Way</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="unitedWay1"
                                value="<?PHP if(isset($row1QBudgeted->unitedWay)){ echo $row1QBudgeted->unitedWay; $FundsBud1[] = $row1QBudgeted->unitedWay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="unitedWay2"
                                value="<?PHP if(isset($row2QBudgeted->unitedWay)){ echo $row2QBudgeted->unitedWay; $FundsBud2[] = $row2QBudgeted->unitedWay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="unitedWay3"
                                value="<?PHP if(isset($row3QBudgeted->unitedWay)){ echo $row3QBudgeted->unitedWay; $FundsBud3[] = $row3QBudgeted->unitedWay;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="unitedWay4"
                                value="<?PHP if(isset($row4QBudgeted->unitedWay)){ echo $row4QBudgeted->unitedWay; $FundsBud4[] = $row4QBudgeted->unitedWay;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">ADECA</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="adeca1"
                                value="<?PHP if(isset($row1QBudgeted->adeca)){ echo $row1QBudgeted->adeca; $FundsBud1[] = $row1QBudgeted->adeca;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="adeca2"
                                value="<?PHP if(isset($row2QBudgeted->adeca)){ echo $row2QBudgeted->adeca; $FundsBud2[] = $row2QBudgeted->adeca;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="adeca3"
                                value="<?PHP if(isset($row3QBudgeted->adeca)){ echo $row3QBudgeted->adeca; $FundsBud3[] = $row3QBudgeted->adeca;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="adeca4"
                                value="<?PHP if(isset($row4QBudgeted->adeca)){ echo $row4QBudgeted->adeca; $FundsBud4[] = $row4QBudgeted->adeca;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">National Childrens Alliance</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="natlChilAlliance1"
                                value="<?PHP if(isset($row1QBudgeted->natlChilAlliance)){ echo $row1QBudgeted->natlChilAlliance; $FundsBud1[] = $row1QBudgeted->natlChilAlliance;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="natlChilAlliance2"
                                value="<?PHP if(isset($row2QBudgeted->natlChilAlliance)){ echo $row2QBudgeted->natlChilAlliance; $FundsBud2[] = $row2QBudgeted->natlChilAlliance;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="natlChilAlliance3"
                                value="<?PHP if(isset($row3QBudgeted->natlChilAlliance)){ echo $row3QBudgeted->natlChilAlliance; $FundsBud3[] = $row3QBudgeted->natlChilAlliance;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="natlChilAlliance4"
                                value="<?PHP if(isset($row4QBudgeted->natlChilAlliance)){ echo $row4QBudgeted->natlChilAlliance; $FundsBud4[] = $row4QBudgeted->natlChilAlliance;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Childrens Trust Fund</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilTrustFund1"
                                value="<?PHP if(isset($row1QBudgeted->chilTrustFund)){ echo $row1QBudgeted->chilTrustFund; $FundsBud1[] = $row1QBudgeted->chilTrustFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilTrustFund2"
                                value="<?PHP if(isset($row2QBudgeted->chilTrustFund)){ echo $row2QBudgeted->chilTrustFund; $FundsBud2[] = $row2QBudgeted->chilTrustFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilTrustFund3"
                                value="<?PHP if(isset($row3QBudgeted->chilTrustFund)){ echo $row3QBudgeted->chilTrustFund; $FundsBud3[] = $row3QBudgeted->chilTrustFund;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilTrustFund4"
                                value="<?PHP if(isset($row4QBudgeted->chilTrustFund)){ echo $row4QBudgeted->chilTrustFund; $FundsBud4[] = $row4QBudgeted->chilTrustFund;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Department of Human Resources</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="deptOfHR1"
                                value="<?PHP if(isset($row1QBudgeted->deptOfHR)){ echo $row1QBudgeted->deptOfHR; $FundsBud1[] = $row1QBudgeted->deptOfHR;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="deptOfHR2"
                                value="<?PHP if(isset($row2QBudgeted->deptOfHR)){ echo $row2QBudgeted->deptOfHR; $FundsBud2[] = $row2QBudgeted->deptOfHR;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="deptOfHR3"
                                value="<?PHP if(isset($row3QBudgeted->deptOfHR)){ echo $row3QBudgeted->deptOfHR; $FundsBud3[] = $row3QBudgeted->deptOfHR;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="deptOfHR4"
                                value="<?PHP if(isset($row4QBudgeted->deptOfHR)){ echo $row4QBudgeted->deptOfHR; $FundsBud4[] = $row4QBudgeted->deptOfHR;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">County Commissions</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="countyComm1"
                                value="<?PHP if(isset($row1QBudgeted->countyComm)){ echo $row1QBudgeted->countyComm; $FundsBud1[] = $row1QBudgeted->countyComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="countyComm2"
                                value="<?PHP if(isset($row2QBudgeted->countyComm)){ echo $row2QBudgeted->countyComm; $FundsBud2[] = $row2QBudgeted->countyComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="countyComm3"
                                value="<?PHP if(isset($row3QBudgeted->countyComm)){ echo $row3QBudgeted->countyComm; $FundsBud3[] = $row3QBudgeted->countyComm;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="countyComm4"
                                value="<?PHP if(isset($row4QBudgeted->countyComm)){ echo $row4QBudgeted->countyComm; $FundsBud4[] = $row4QBudgeted->countyComm;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">City Councils</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="cityCouncil1"
                                value="<?PHP if(isset($row1QBudgeted->cityCouncil)){ echo $row1QBudgeted->cityCouncil; $FundsBud1[] = $row1QBudgeted->cityCouncil;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="cityCouncil2"
                                value="<?PHP if(isset($row2QBudgeted->cityCouncil)){ echo $row2QBudgeted->cityCouncil; $FundsBud2[] = $row2QBudgeted->cityCouncil;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="cityCouncil3"
                                value="<?PHP if(isset($row3QBudgeted->cityCouncil)){ echo $row3QBudgeted->cityCouncil; $FundsBud3[] = $row3QBudgeted->cityCouncil;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="cityCouncil4"
                                value="<?PHP if(isset($row4QBudgeted->cityCouncil)){ echo $row4QBudgeted->cityCouncil; $FundsBud4[] = $row4QBudgeted->cityCouncil;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Local Grants</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="localGrants1"
                                value="<?PHP if(isset($row1QBudgeted->localGrants)){ echo $row1QBudgeted->localGrants; $FundsBud1[] = $row1QBudgeted->localGrants;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="localGrants2"
                                value="<?PHP if(isset($row2QBudgeted->localGrants)){ echo $row2QBudgeted->localGrants; $FundsBud2[] = $row2QBudgeted->localGrants;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="localGrants3"
                                value="<?PHP if(isset($row3QBudgeted->localGrants)){ echo $row3QBudgeted->localGrants; $FundsBud3[] = $row3QBudgeted->localGrants;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="localGrants4"
                                value="<?PHP if(isset($row4QBudgeted->localGrants)){ echo $row4QBudgeted->localGrants; $FundsBud4[] = $row4QBudgeted->localGrants;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Area Schools</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="areaSchools1"
                                value="<?PHP if(isset($row1QBudgeted->areaSchools)){ echo $row1QBudgeted->areaSchools; $FundsBud1[] = $row1QBudgeted->areaSchools;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="areaSchools2"
                                value="<?PHP if(isset($row2QBudgeted->areaSchools)){ echo $row2QBudgeted->areaSchools; $FundsBud2[] = $row2QBudgeted->areaSchools;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="areaSchools3"
                                value="<?PHP if(isset($row3QBudgeted->areaSchools)){ echo $row3QBudgeted->areaSchools; $FundsBud3[] = $row3QBudgeted->areaSchools;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="areaSchools4"
                                value="<?PHP if(isset($row4QBudgeted->areaSchools)){ echo $row4QBudgeted->areaSchools; $FundsBud4[] = $row4QBudgeted->areaSchools;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Corporate Donations</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="corpDonations1"
                                value="<?PHP if(isset($row1QBudgeted->corpDonations)){ echo $row1QBudgeted->corpDonations; $FundsBud1[] = $row1QBudgeted->corpDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="corpDonations2"
                                value="<?PHP if(isset($row2QBudgeted->corpDonations)){ echo $row2QBudgeted->corpDonations; $FundsBud2[] = $row2QBudgeted->corpDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="corpDonations3"
                                value="<?PHP if(isset($row3QBudgeted->corpDonations)){ echo $row3QBudgeted->corpDonations; $FundsBud3[] = $row3QBudgeted->corpDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="corpDonations4"
                                value="<?PHP if(isset($row4QBudgeted->corpDonations)){ echo $row4QBudgeted->corpDonations; $FundsBud4[] = $row4QBudgeted->corpDonations;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Private Donations</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="privDonations1"
                                value="<?PHP if(isset($row1QBudgeted->privDonations)){ echo $row1QBudgeted->privDonations; $FundsBud1[] = $row1QBudgeted->privDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="privDonations2"
                                value="<?PHP if(isset($row2QBudgeted->privDonations)){ echo $row2QBudgeted->privDonations; $FundsBud2[] = $row2QBudgeted->privDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="privDonations3"
                                value="<?PHP if(isset($row3QBudgeted->privDonations)){ echo $row3QBudgeted->privDonations; $FundsBud3[] = $row3QBudgeted->privDonations;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="privDonations4"
                                value="<?PHP if(isset($row4QBudgeted->privDonations)){ echo $row4QBudgeted->privDonations; $FundsBud4[] = $row4QBudgeted->privDonations;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Fundraisers</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fundraisers1"
                                value="<?PHP if(isset($row1QBudgeted->fundraisers)){ echo $row1QBudgeted->fundraisers; $FundsBud1[] = $row1QBudgeted->fundraisers;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fundraisers2"
                                value="<?PHP if(isset($row2QBudgeted->fundraisers)){ echo $row2QBudgeted->fundraisers; $FundsBud2[] = $row2QBudgeted->fundraisers;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fundraisers3"
                                value="<?PHP if(isset($row3QBudgeted->fundraisers)){ echo $row3QBudgeted->fundraisers; $FundsBud3[] = $row3QBudgeted->fundraisers;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fundraisers4"
                                value="<?PHP if(isset($row4QBudgeted->fundraisers)){ echo $row4QBudgeted->fundraisers; $FundsBud4[] = $row4QBudgeted->fundraisers;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Bank Interest</td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="bankInterest1"
                                value="<?PHP if(isset($row1QBudgeted->bankInterest)){ echo $row1QBudgeted->bankInterest; $FundsBud1[] = $row1QBudgeted->bankInterest;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="bankInterest2"
                                value="<?PHP if(isset($row2QBudgeted->bankInterest)){ echo $row2QBudgeted->bankInterest; $FundsBud2[] = $row2QBudgeted->bankInterest;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="bankInterest3"
                                value="<?PHP if(isset($row3QBudgeted->bankInterest)){ echo $row3QBudgeted->bankInterest; $FundsBud3[] = $row3QBudgeted->bankInterest;} ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="bankInterest4"
                                value="<?PHP if(isset($row4QBudgeted->bankInterest)){ echo $row4QBudgeted->bankInterest; $FundsBud4[] = $row4QBudgeted->bankInterest;} ?>" /></td>
                </tr>
                <?PHP
                        //check to see if they have any other incomes entered
                        $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
                        $resultOI = @mysql_query($sqlOI) or mysql_error();

                        $numRecords = mysql_num_rows($resultOI);
                        if ($numRecords > 0){
                                while ($row = mysql_fetch_object($resultOI)) {
                                echo '<tr align="center"><td align="left">'.$row->IncomeName.'</td>';
                                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OI1Q'.$row->OIncomeID.'"
                                value="';
                                if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud1[] = $rowOIValues->oiValue;}
                                echo '" /></td>';
                                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OI2Q'.$row->OIncomeID.'"
                                value="';
                                if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud2[] = $rowOIValues->oiValue;}
                                echo '" /></td>';
                                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OI3Q'.$row->OIncomeID.'"
                                value="';
                                if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud3[] = $rowOIValues->oiValue;}
                                echo '" /></td>';
                                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                echo '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="OI4Q'.$row->OIncomeID.'"
                                value="';
                                if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud4[] = $rowOIValues->oiValue;}
                                echo '" /></td>';
                                echo '</tr>';
                                }
                        }
                ?>
                <!--
                <tr align="center">
                        <td align="center"><b>Total Funds</b></td>
                        <td align="right"><b><?PHP $totFundsBudget = 0;
                                foreach ($FundsBud1 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totFundsBudget = 0;
                                foreach ($FundsBud2 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totFundsBudget = 0;
                                foreach ($FundsBud3 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><?PHP $totFundsBudget = 0;
                                foreach ($FundsBud4 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                </tr>
                -->
                </table>
                                <?PHP if ($EOYAvailable == 1){
                                        if ($_SESSION['admin'] != 1)
                                                echo '<p><input type="submit" name="submit" value="Update Budgets" /></p>';
                                }
                                ?>
                                <input type="hidden" name="centerID" value="<?PHP echo $centerID; ?>" />
                                <input type="hidden" name="fiscalYear" value="<?PHP echo $fiscalYear; ?>" />
                                <input type="hidden" name="Update1" value="<?PHP echo $Update1; ?>" />
                                <input type="hidden" name="Update2" value="<?PHP echo $Update2; ?>" />
                                <input type="hidden" name="Update3" value="<?PHP echo $Update3; ?>" />
                                <input type="hidden" name="Update4" value="<?PHP echo $Update4; ?>" />
                                <input type="hidden" name="CY" value="<?PHP echo $CY; ?>" />
                        </form>
			</td>
		</tr>
		<tr>
		      <td>
		              <center><div class=nav><?PHPphp echo '<a href="eoyreports.php?center='.$centerID.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>
		      </td>
		</tr>
		</table>
		<!-- <?PHP if($_SESSION['admin'] > 0){
	               echo '<tr><td><p><center><a href="qreportAdmin.php?from=6">Return to Center List</a></center></p></td></tr>';
	        } ?> -->
	</center>
	</td>
</tr>
</table>
</body>
<?PHP
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>


