<div>
    <style>
        *{
            font-size: 9pt;
            font-family: Arial, Helvetica, sans-serif;
        }
        .column {
            float: left;
            padding: 10px;
        }
        
        .left, .right {
            width: 25%;
        }
        
        .middle {
            width: 50%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        @page { 
            margin-top: 0.52in;
            margin-left: 0.2in;
            margin-right: 4.6in;
            margin-bottom: 0.15in;
            size: 8.5in 11in;
        }
        .checkmark {
            display: inline-block;
            transform: rotate(45deg);
            height: 12.5px;
            width: 6px;
            border-bottom: 2px solid #000000;
            border-right: 2px solid #000000;
        }
    </style>
    
    <div style="position: fixed;margin-top:1.40in;margin-left: 0.2in">
        {{ $Date }}
    </div>
    <div style="position: fixed;margin-top:2in;margin-left: 0.2in">
        {{ $StudentName }}
    </div>
    <div style="position: fixed;margin-top:2.80in;margin-left: 0.10in;width:3.80in">
        <table style="border-collapse: collapse;border-style:hidden;">
        @foreach($TransactionPayment as $transactionpayment)
        <tr style="border-collapse: collapse;border-style:hidden;">
            <td style="width: 2.69in;height:0.18in;border-collapse: collapse;border-style:hidden;">
                <div style="line-height: 17.60px">{{ $transactionpayment->getPaymentDetail->payment_detail_name }}</div>
            @if($transactionpayment->getPaymentDetail->purpose!=null)
                <div style="line-height: 20.50px">
                    {{ $transactionpayment->getPaymentDetail->purpose }}
                </div>
            @endif
            </td>
            <td style="width: 1.11in;vertical-align: bottom;border-collapse: collapse;border-style:hidden;">
            <div style="margin-left:0.20in">
            {{ number_format($transactionpayment->price*$transactionpayment->qty, 2, '.', ',') }}
            <?php
                $total+=$transactionpayment->price*$transactionpayment->qty
            ?>
            </div>
            </td>
        </tr>
        @endforeach
        </table>
    </div>
    {{-- <div style="position: fixed;margin-top:2.80in;margin-left: 0.2in;line-height: 138%;width:2.67in">
        @foreach($TransactionPayment as $transactionpayment)
            {{ $transactionpayment->getPaymentDetail->payment_detail_name }}
            {{ $transactionpayment->getPaymentDetail->purpose }}
            <div style="align-text:left">25,000,000.00</div>
            <br>
        @endforeach
    </div> --}}
    {{-- <div style="position: fixed;margin-top: 2.80in;margin-left: 2.97in;line-height: 40%">
        @foreach($TransactionPayment as $transactionpayment_price)
            <p>{{ number_format($transactionpayment_price->price*$transactionpayment_price->qty, 2, '.', ',') }}</p>
            <?php
                // $total+=$transactionpayment_price->price*$transactionpayment_price->qty
            ?>
        @endforeach
    </div> --}}
    <div style="position: fixed;margin-top: 4.86in;margin-left: 3.05in">
            <p>{{ number_format($total, 2, '.', ',') }}</p>
    </div>
    <div style="position: fixed;margin-top: 5.10in;margin-left: 0.4in;line-height: 200%;">
            <p style="font-size: 10pt;text-transform:capitalize;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                    $sample_num=round($total, 2);
                    
                    $numberTransformer = $numberToWords->getNumberTransformer('en');
                    echo $numberTransformer->toWords($sample_num).' pesos';
                    // echo convert_number_to_words($sample_num).' Pesos';
                    if(strpos($sample_num,".") !== false){
                    // echo "decimal";
                    list($int, $dec) = explode('.', $sample_num);
                    // echo ' And '.convert_number_to_words($dec). ' Cents';
                    echo ' and '.$numberTransformer->toWords($dec).' cents';
                    }else{
                        // echo "not a decimal";
                    }
                    echo ' only';
                ?>
            </p>
    </div>
    
    {{-- @if($ModeOfPayment==1) --}}
        <div style="position: fixed;margin-top: 5.98in;margin-left: 0.28in">
                <div class="checkmark"></div>
        </div>
    {{-- @endif --}}
    {{-- @if($ModeOfPayment==2) --}}
        <div style="position: fixed;margin-top: 6.16in;margin-left: 0.28in">
                <div class="checkmark"></div>
        </div>
    {{-- @endif --}}
    {{-- @if($ModeOfPayment==3) --}}
        <div style="position: fixed;margin-top: 6.35in;margin-left: 0.28in">
                <div class="checkmark"></div>
        </div>
    {{-- @endif --}}
    
    <div style="position: fixed;margin-top: 7in;margin-left: 2.36in">
            <p>{{ $Collecting_Officer }}</p>
    </div>
    
    
    
</div>



















<?php
//     function convert_number_to_words($number) {

// $hyphen      = '-';
// $conjunction = ' ';
// $separator   = ' ';
// $negative    = 'negative ';
// $decimal     = ' point ';
// $dictionary  = array(
//     0                   => 'Zero',
//     1                   => 'One',
//     2                   => 'Two',
//     3                   => 'Three',
//     4                   => 'Four',
//     5                   => 'Five',
//     6                   => 'Six',
//     7                   => 'Seven',
//     8                   => 'Eight',
//     9                   => 'Nine',
//     10                  => 'Ten',
//     11                  => 'Eleven',
//     12                  => 'Twelve',
//     13                  => 'Thirteen',
//     14                  => 'Fourteen',
//     15                  => 'Fifteen',
//     16                  => 'Sixteen',
//     17                  => 'Seventeen',
//     18                  => 'Eighteen',
//     19                  => 'Nineteen',
//     20                  => 'Twenty',
//     30                  => 'Thirty',
//     40                  => 'Forty',
//     50                  => 'Fifty',
//     60                  => 'Sixty',
//     70                  => 'Seventy',
//     80                  => 'Eighty',
//     90                  => 'Ninety',
//     100                 => 'Hundred',
//     1000                => 'Thousand',
//     100000              => 'Hundred',
//     10000000            => 'Billion'
// );

// if (!is_numeric($number)) {
//     return false;
// }

// if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
//     // overflow
//     trigger_error(
//         'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
//         E_USER_WARNING
//     );
//     return false;
// }

// if ($number < 0) {
//     return $negative . convert_number_to_words(abs($number));
// }

// $string = $fraction = null;

// if (strpos($number, '.') !== false) {
//     list($number, $fraction) = explode('.', $number);
// }

// switch (true) {
//     case $number < 21:
//         $string = $dictionary[$number];
//         break;
//     case $number < 100:
//         $tens   = ((int) ($number / 10)) * 10;
//         $units  = $number % 10;
//         $string = $dictionary[$tens];
//         if ($units) {
//             $string .= $hyphen . $dictionary[$units];
//         }
//         break;
//     case $number < 1000:
//         $hundreds  = $number / 100;
//         $remainder = $number % 100;
//         $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
//         if ($remainder) {
//             $string .= $conjunction . convert_number_to_words($remainder);
//         }
//         break;
//     case $number < 100000:
//         $thousands   = ((int) ($number / 1000));
//         $remainder = $number % 1000;

//         $thousands = convert_number_to_words($thousands);

//         $string .= $thousands . ' ' . $dictionary[1000];
//         if ($remainder) {
//             $string .= $separator . convert_number_to_words($remainder);
//         }
//         break;
//     case $number < 10000000:
//         $lakhs   = ((int) ($number / 100000));
//         $remainder = $number % 100000;

//         $lakhs = convert_number_to_words($lakhs);

//         $string = $lakhs . ' ' . $dictionary[100000];
//         if ($remainder) {
//             $string .= $separator . convert_number_to_words($remainder);
//         }
//         break;
//     case $number < 1000000000:
//         $crores   = ((int) ($number / 10000000));
//         $remainder = $number % 10000000;

//         $crores = convert_number_to_words($crores);

//         $string = $crores . ' ' . $dictionary[10000000];
//         if ($remainder) {
//             $string .= $separator . convert_number_to_words($remainder);
//         }
//         break;
//     default:
//         $baseUnit = pow(1000, floor(log($number, 1000)));
//         $numBaseUnits = (int) ($number / $baseUnit);
//         $remainder = $number % $baseUnit;
//         $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
//         if ($remainder) {
//             $string .= $remainder < 100 ? $conjunction : $separator;
//             $string .= convert_number_to_words($remainder);
//         }
//         break;
// }

// if (null !== $fraction && is_numeric($fraction)) {
//     $string .= $decimal;
//     $words = array();
//     foreach (str_split((string) $fraction) as $number) {
//         $words[] = $dictionary[$number];
//     }
//     $string .= implode(' ', $words);
// }

// return $string;
// }
?>
