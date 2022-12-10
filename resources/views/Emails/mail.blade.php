<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        html {
            font-family: sans-serif;
            width: 700px !important;
            margin: auto !important;
            ;
        }

        table {
            border-collapse: collapse;
            border: 2px solid rgb(200, 200, 200);
            font-size: 0.8rem;
            width: 700px !important;

        }

        td,
        th {
            border: 1px solid rgb(190, 190, 190);
            padding: 10px 20px;
        }

        th {
            background-color: rgb(235, 235, 235);
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) td {
            background-color: rgb(250, 250, 250);
        }

        tr:nth-child(odd) td {
            background-color: rgb(245, 245, 245);
        }

        caption {
            padding: 10px;
        }
    </style>
    <style lang="scss">
table {
    border-collapse: collapse;
    margin: 0 auto;
    width: 100%;
    margin-top: 40px;

    tr {
        background: #f2f2f2;
    }

    th {
        font-size: 15px;
        background-color: #03d361;
        color: #1a181f;
        text-transform: uppercase;
    }
}

table th,
table td {
    padding: 15px;
    text-align: center;
}

@media screen and (max-width: 600px) {
    table {
        border: 0;

        thead {
            display: none;
        }

        tr {
            display: block;
            margin-bottom: 10px;
        }

        td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: 14px;
            text-align: right;

            &::before {
                content: attr(data-label);
                float: left;
                font-weight: 900;
                text-transform: uppercase;
            }

            &::last-child {
                border-bottom: 0;
            }
        }
    }
}
</style>
</head>

<body>

    <table>
        @if ($status === 0)
            <tr>
                <th colspan="3"> شحنتك من تاريخ</th>
                <td colspan="3">
                    <span>{{ date('l d, F, Y', strtotime($order['order_date'])) }}</span>

                </td>
                </tr><tr>
                <th colspan="3">تفاصيل</th>
                <td colspan="3">
                    <span>{{ $order['description'] }}</span>

                </td>
            </tr>

            <tr>
                <th colspan="3">
                    تاريخ التوصيل المتوقع
                </th>
                <td colspan="3">
                    <span>{{ date('l d, F, Y', strtotime($order['expexted_date_from'])) }}</span>
                    <b> - </b>
                    <span>
                        {{ date('l d, F, Y', strtotime($order['expexted_date_to'])) }}</span>
                </td>
            </tr>
        @endif
        @if ($status === 1)
            <tr>
                <th colspan="3"> تم الشحن بتاريخ </th>
                <td colspan="3">
                    <span>{{ date('l d, F, Y', strtotime($order['shipping_date'])) }}</span>
                </td>
                </tr><tr>
                <th colspan="3">تفاصيل</th>
                <td colspan="3">
                    <span>{{ $order['description'] }}</span>

                </td>
            </tr>
        @endif
        @if ($status === 2)
            <tr>
                <th colspan="3"> شحنتك في طريقها إليك بتاريخ</th>
                <td colspan="3">
                    <span>{{ date('l d, F, Y', strtotime($order['on_way_date'])) }}</span>
                </td>
                </tr><tr>
                <th colspan="3">تفاصيل</th>
                <td colspan="3">
                    <span>{{ $order['description'] }}</span>

                </td>
            </tr>
        @endif
        @if ($status === 3)
            <tr>
                <th colspan="3"> تم إستلام الشحنة بتاريخ</th>
                <td colspan="3">
                    <span>{{ date('l d, F, Y', strtotime($order['receive_date'])) }}</span>
                </td>

                </tr><tr>
                <th colspan="3">تفاصيل</th>
                <td colspan="3">
                    <span>{{ $order['description'] }}</span>

                </td>

"
            </tr>
        @endif
                <a  href="{{ route('follow', $order['uuid']) }}">تتبع الشحنة</a>

    </table>
</body>

</html>
