<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Receipt</title>
    <style>

        .invoice {
            position: relative;
            background-color: #FFF;
            padding: 15px;
            font-size: 1.3rem;
        }
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        .invoice table td,.invoice table th {
            padding: 5px;
            border-bottom: 1px solid #fff
        }
        .invoice table td h2 {
            margin: 0;
            font-size: bold;
            color: #0d6efd;
            font-size:1.3rem;
        }
        .invoice table .qty {
            text-align: right;
        }

        @media print { body.receipt { width: 80mm; height:100%; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale !important; position:absolute} }
        body.receipt { 
		width: 91mm;
		height:100%;
		/*margin: 5mm;*/
		padding: 3mm;
		font-weight: bold;
		overflow-x: hidden;
		font-size:1.3rem;
	}
	body.receipt  .smoothed {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale !important;

	}
    body.receipt .sheet { width: 91mm; height:100%} /* change height as you like */
    body, embed, html {
    width: 80mm !important;
    }
    </style>

</head>

<body class="receipt">
        <div class="invoice overflow-auto">
            <section class="sheet smoothed">
                            <table width="50%">
                            <?php if($restaurant['photo_file'] != '' ){ ?>
                                <tr>
                                    <td class="text-center"><img src="<?= base_url();?>assets/images/logo/<?= $restaurant['photo_file']; ?>" style="width:30%"></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="text-center"><h2><?php echo $restaurant['restaurant_name'] ?></h2></td>
                                </tr><tr>
                                    <td class="text-center"><?php echo $restaurant['restaurant_address'] ?></td>
                                </tr><tr>
                                    <td class="text-center ">Call: <?php echo $restaurant['contact_no'] ?></td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <td>
                                        Name : <?= ($bill['billHead']['c_name'] ?? '').' - '.($bill['billHead']['mobile'] ?? '') ;?> 
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        Date : <?php echo date("d/m/Y h:i:s",strtotime($bill['billHead']['created_date'])) ?> <br />
                                        Cashier : CASHIER <br />
                                        Bill No : <?php echo $bill['billHead']['invoice_no'] ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td >
                                        <table >
                                            <tr class="border-top border-bottom">
                                                <td width="50%">Item </td> 
                                                <td width="10%" class="text-center qty">Qty</td> 
                                                <td width="20%" class="text-right qty">Price</td> 
                                                <td width="20%" class="text-right qty">Amount</td> 
                                            </tr>
                                            <?php 
                                                $qnty = 0;
                                                foreach($bill['billItems'] as $billd){
                                                    $qnty 			= intval($qnty) + intval($billd['qty']); 
                                                ?>
                                            <tr>
                                                <td><?= $billd['item_name'] ?></td> 
                                                <td class="text-center qty"><?= $billd['total_qty'] ?></td> 
                                                <td class="text-right qty"><?= number_format($billd['amount'],2) ?></td> 
                                                <td class="text-right qty"><?= number_format($billd['total_price'],2) ?></td> 
                                            </tr>
                                            <?php } ?>
                                            <tr class="border-top">

                                                <td width="40%"></td> 
                                                <td width="20%">Total Qty : &nbsp;&nbsp;&nbsp;<?= $qnty; ?></td> 
                                                <td ></td> 
                                                <td  class="text-right"  width="30%">Sub Total : &nbsp;&nbsp;&nbsp;<?= number_format($bill['billHead']['sub_total'],2) ?></td> 
                                            </tr>
                                            <?php if(isset($bill['billHead']['tax_amt']) && $bill['billHead']['tax_amt'] >0){ ?>
                                            <tr>
                                                <td ></td> 
                                                <td ><?= number_format($bill['billHead']['sub_total'],2) ?> @ SGST</td> 
                                                <td ><?= $bill['billHead']['sgst_percent'] ;?>%</td> 
                                                <td class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format(($bill['billHead']['sgst_amt']),2); ?></td> 
                                            </tr>
                                            <tr>
                                                <td ></td> 
                                                <td ><?= number_format($bill['billHead']['sub_total'],2) ?> @ CGST</td> 
                                                <td colspan = 2 ><?= $bill['billHead']['cgst_percent'] ;?>%</td> 
                                                <td class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format(($bill['billHead']['cgst_amt'] ),2); ?></td> 
                                            </tr>
                                            <tr>
                                                <td ></td> 
                                                <td ><?= number_format($bill['billHead']['sub_total'],2) ?> @ VAT</td> 
                                                <td ><?= $bill['billHead']['vat_percent'] ;?>%</td> 
                                                <td class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format(($bill['billHead']['vat_amt']),2); ?></td> 
                                            </tr>
                                            <?php } ?>
                                            <?php if(isset($bill['billHead']['discount_amt']) && $bill['billHead']['discount_amt'] >0){ ?>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
                                                    <td colspan = 2 class="text-right">Total</td> 
                                                    <td colspan = 2 class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format(($bill['billHead']['total']),2); ?></td> 
                                                </tr>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
                                                    <td >Discount</td> 
                                                    <td class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format($bill['billHead']['discount_amt'],2); ?></td> 
                                                </tr>
                                            <?php } ?>
                                                <tr class="border-top border-bottom">
                                                    <td ></td> 
                                                    <td ></td> 
                                                    <td >Grand Total</td> 
                                                    <td class="text-left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= number_format($bill['billHead']['grand_total'],2); ?></td> 
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
                                <tr>
                                    <td class="text-center"><b>FSSAI Lic No <?= $restaurant['fssai_no'] ;?></b></td>
                                </tr>
                                <?php }if($restaurant['company_name'] != '' ){ ?>
                                <tr>
                                    <td class="text-center"><b><?= $restaurant['company_name'] ;?></b></td>
                                </tr>
                                <?php } if($restaurant['gstin_no'] != '' ){ ?>
                                <tr>
                                    <td class="text-center"><b>GSTIN <?= $restaurant['gstin_no'] ;?></b></td>
                                </tr>
                                <?php } if($restaurant['email'] != '' ){ ?>
                                <tr>
                                    <td class="text-center">
                                        write to us at <br />
                                        <b><?= $restaurant['email'] ;?></b>
                                    </td>
                                </tr>
                                <?php } if($restaurant['qr_code'] != '' ){ ?>
                                <tr>
                                    <td class="text-center"><img src="<?= base_url();?>assets/images/qr/<?= $restaurant['qr_code']; ?>" style="width:30%"></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </section>
        </div>
</body>


</html>