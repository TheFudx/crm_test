<!DOCTYPE html>
<html lang="en">
<head>
    <title>KOT Receipt </title>
    <style>
        *{
            margin:0px;
            padding:0px;
            box-sizing: border-box;
        }
        .receiptPDF{
            font-size: 10px;
        }
        .invoice{

            padding:2px !important;
        }
        @media print { body.receipt { width: 75mm; height:100%; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale !important; position:absolute} }
        body .receipt { 
		width: 75mm;
		height:100%;
	}
	body.receipt  .smoothed {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale !important;
	}
    body.receipt .sheet { width: 75mm; height:100%} /* change height as you like */
    body, embed, html {
    width: 75mm !important;
    }
    </style>

</head>
<body class="receipt">
        <div class="invoice overflow-auto">
            <section class="sheet smoothed">
                            <table style="width:100%">
                            <?php if($restaurant['photo_file'] != '' ){ ?>
		<tr>
			<!--<td class="text-center"><img src="<?= base_url();?>assets/images/logo/<?= $restaurant['photo_file']; ?>" style="width:30%; margin-left:6.5rem"  ></td>-->
		</tr>
		<?php } ?>
		<tr>
			<td class="text-center"><h2  style="font-size:22px;text-align:center"><b><?php echo $restaurant['restaurant_name'] ?></b></h2></td>
		</tr>
		<tr>
			<td>
				<table width="100%" style="border-top: 1px dashed;padding-top:10px;">
					<tr >
						<td width="33%" style="text-align:center">Date: <br /><b><?php echo date("d/m/Y",strtotime($kot[0]['created_date'])) ?></b></td> 
						<td width="33%" style="text-align:center">Table No. <br /><b><?php echo $kot[0]['tablename'] ?></b></td> 
						<td width="33%" style="text-align:center">KOT No. <br /><b><?php echo $kot[0]['kot'] ?></b></td> 
					</tr>
					<tr style="">
						<td style="text-align:center">Waiter ID: <br/><b><?php echo $kot[0]['username'] ?></b></td> 
						<td style="text-align:center">No Of Pax. <br/><b><?php echo $kot[0]['capacity'] ?></b></td> 
						<td style="text-align:center">Time: <br/><b><?php echo date("h:i:s",strtotime($kot[0]['created_date'])) ?></b></td> 
					</tr>
				</table>
			</td> 
		</tr>
		<tr>
			<td>
				<table width="100%" style="border-top: 1px dashed;padding:5px 0px; ">
					<tr class="border-bottom">
						<td  style="width=10%;text-align:center" class=" nowrap"><b>SrNo</b> </td> 
						<td style="width=40%;text-align:center" > <b>Items</b></td> 
						<td style="width=10%;text-align:center" > <b>Qnty</b></td> 
						<td style="width=40%;text-align:center" ><b>Cooking <br/> Instruction </b> </td> 
					</tr>
					<?php 
						$i = 0;
						$total_qnty 	= 0;
						$total_items 	= 0;
						foreach($kot as $kotd){
							$i++;
							$qnty 			= $kotd['qty'];
							$itemname 		= $kotd['item_name'];
							$instruction 	= $kotd['instruction'];

							$total_qnty = intval($total_qnty) + intval($qnty);
							$total_items++;
						?>
					<tr >
						<td style="text-align:center"><?= $i ?></td> 
						<td style="text-align:left"><?= $itemname;  ?></td> 
						<td style="text-align:center"><?= $qnty ?></td> 
						<td ><?= $instruction; ?></td> 
					</tr>
					<?php } ?>

					<tr >
                        <td colspan = 2 style="width=20%;text-align:left">No of Items :</td>
                        <td><?= $total_items ;?></td>
						<td></td>
                        <td></td>
					</tr>
					<tr >
                        <td colspan = 2 style="width=20%;text-align:left">No of Quantity :</td>
						<td ><?= $total_qnty ;?></td> 
						<td></td>
                        <td></td>
					</tr>
		
                    <tr style="padding:5px 0px;">
                        <td></td>
                        <td></td>
                    <td colspan = 2  style="vertical-align:top;padding:5px 0px;width=40%;text-align:center" ><b>Signature</b></td> 
                    </tr>
				</table>
			</td> 
		</tr>
                            </table>
                        </section>
        </div>
</body>


</html>