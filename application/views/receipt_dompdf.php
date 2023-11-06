<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bill Receipt</title>
    <style>
        *{
            margin:0px;
            padding:0px;
            box-sizing: border-box;
        }
        .receiptPDF{
            font-size: 14px;
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
                                    <!--<td class="text-center"><img src="<?= base_url();?>assets/images/logo/<?= $restaurant['photo_file']; ?>" alt="LOGO" style="width:50%; "></td>-->
                                </tr>
                                <?php } ?>
                                <tr >
                                    <td ><p class="receiptPDF" style="font-size:22px;text-align:center" ><?php echo $restaurant['restaurant_name'] ?></p>
                                    </td>
                                <tr>
                                    <td><p class="receiptPDF" style=" text-align:center"><?php echo $restaurant['restaurant_address'] ?></p>
                                </td>
                                </tr><tr>
                                    <td><p class="receiptPDF" style=" text-align:center;margin-bottom:12px;">Call: <?php echo $restaurant['contact_no'] ?></p></td>
                                </tr>
                                <tr >
                                    <td style="border-top: 1px dashed;padding-left: 5px;padding-top:10px;">
                                        Name : <?= ($bill['billHead']['c_name'] ?? '').' - '.($bill['billHead']['mobile'] ?? '') ;?> 
                                    </td> 
                                </tr>
                                <tr class="receiptPDF">
                                    <td style="padding: 5px;padding-bottom:10px; "><p >
                                    Date : <?php echo date("d/m/Y h:i:s",strtotime($bill['billHead']['created_date'])) ?> </p>
                                    <p >Cashier : CASHIER </p>
                                    <p > Bill No : <?php echo $bill['billHead']['invoice_no'] ?></p>
                                    </td> 
                                </tr>
                                <tr>
                                    <td >
                                        <table style="width:100%; border-top: 1px dashed; border-bottom: 1px dashed; margin-bottom:15px; padding:5px 0px" >
                                            <tr >
                                                <td style="width:37%; font-weight: bold;" class="receiptPDF">Item </td> 
                                                <td style="width:10%; font-weight: bold;" class="text-center qty receiptPDF">Qty</td> 
                                                <td style="width:20%; font-weight: bold;" class="text-right qty receiptPDF">Price</td> 
                                                <td style="width:20%; font-weight: bold;"  class=" qty receiptPDF">Amount</td> 
                                            </tr>
                                            <?php 
                                                $qnty = 0;
                                                foreach($bill['billItems'] as $billd){
                                                    $qnty 			= intval($qnty) + intval($billd['qty']); 
                                                ?>
                                            <tr>
                                                <td class="receiptPDF"><?= $billd['item_name'] ?></td> 
                                                <td class="text-center qty receiptPDF"><?= $billd['total_qty'] ?></td> 
                                                <td class="text-right qty receiptPDF"><?= number_format($billd['amount'],2) ?></td> 
                                                <td class="text-right qty receiptPDF"><?= number_format($billd['total_price'],2) ?></td> 
                                            </tr>
                                            <?php } ?>
                                            <tr >
                                                <td style="text-align:center, ">Total Qty : <b><?= $qnty; ?></b>
                                                </td>
                                                
                                                <td colspan=3 style="text-align:center; ">Sub Total : <b><?= number_format($bill['billHead']['sub_total'],2) ?></b></td> 
                                            </tr>
                                            <?php if(isset($bill['billHead']['tax_amt']) && $bill['billHead']['tax_amt'] >0){ ?>
                                            <tr class="receiptPDF">
                                                <td style="text-align:right" > <?= number_format($bill['billHead']['sub_total'],2) ?> @ SGST </td> 
                                                <td style="text-align:center" colspan=2  > <?= $bill['billHead']['sgst_percent'] ;?>% </td> 
                                                <td style="text-align:left" > <?= number_format(($bill['billHead']['sgst_amt']),2); ?></td> 
                                            </tr>
                                            <tr class="receiptPDF">
                                                <td style="text-align:right" ><?= number_format($bill['billHead']['sub_total'],2) ?> @ CGST </td> 
                                                <td  style="text-align:center" colspan=2><?= $bill['billHead']['cgst_percent'] ;?>% </td> 
                                                <td style="text-align:left"> <?= number_format(($bill['billHead']['cgst_amt'] ),2); ?></td> 
                                            </tr>
                                            <tr class="receiptPDF">
                                                <td style="text-align:right"><?= number_format($bill['billHead']['sub_total'],2) ?> @ VAT </td> 
                                                <td style="text-align:center" colspan=2><?= $bill['billHead']['vat_percent'] ;?>% </td> 
                                                <td style="text-align:left"> <?= number_format(($bill['billHead']['vat_amt']),2); ?></td> 
                                            </tr>
                                            <?php } ?>
                                            <?php if(isset($bill['billHead']['discount_amt']) && $bill['billHead']['discount_amt'] >0){ ?>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
                                                    <td class="receiptPDF" colspan = 2 class="text-right">Total</td> 
                                                    <td colspan = 2 class="text-left"><?= number_format(($bill['billHead']['total']),2); ?></td> 
                                                </tr>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
                                                    <td class="receiptPDF">Discount</td> 
                                                    <td class="text-left"><?= number_format($bill['billHead']['discount_amt'],2); ?></td> 
                                                </tr>
                                            <?php } ?>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
 
                                                    <td  colspan = 3 style="text-align:center; ">Grand Total : <b><?= number_format($bill['billHead']['grand_total'],2); ?></b></td> 
                                                     
                                                </tr>
                                            <?php if(false) { ?>
                                            <tr class="border-top">
                                                <td ></td> 
                                                <td ><small>Round Off</small></td> 
                                                <td ><small>-0.40</small></td> 
                                            </tr>
                                            <tr class="border-bottom">
                                            <td ></td> 
                                                <td ><b>Grand Total</b></td> 
                                                <td  ><b>386.00</b></td> 
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </td> 
                                </tr>
                                <?php if($restaurant['fssai_no'] != '' ){ ?>
                                <tr style="margin-top:1rem;">
                                    <td class="text-center receiptPDF" style="text-align:center;"><b>FSSAI Lic No <?= $restaurant['fssai_no'] ;?></b></td>
                                </tr>
                                <?php }if($restaurant['company_name'] != '' ){ ?>
                                <tr>
                                    <td class="text-center receiptPDF" style="text-align:center;"><b><?= $restaurant['company_name'] ;?></b></td>
                                </tr>
                                <?php } if($restaurant['gstin_no'] != '' ){ ?>
                                <tr>
                                    <td class="text-center receiptPDF" style="text-align:center"><b>GSTIN <?= $restaurant['gstin_no'] ;?></b></td>
                                </tr>
                                <?php } if($restaurant['email'] != '' ){ ?>
                                <tr>
                                    <td class="text-center receiptPDF" style="text-align:center">
                                        write to us at <br />
                                        <b><?= $restaurant['email'] ;?></b>
                                    </td>
                                </tr>
                                <?php } if($restaurant['qr_code'] != '' ){ ?>
                                <tr>
                                    <!--<td class="text-center "><img src="<?= base_url();?>assets/images/qr/<?= $restaurant['qr_code']; ?>" alt="QR" style="width:30%"></td>-->
                                </tr>
                                <?php } ?>
                            </table>
                        </section>
        </div>
</body>


</html>