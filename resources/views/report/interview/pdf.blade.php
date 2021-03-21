<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>คะแนนการสัมภาษณ์{{ $dorm->name }}</title>
    <style type="text/css">
        @font-face {
            font-family: 'TH';
            src: url({{ storage_path('fonts\THSarabun.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'TH';
            src: url({{ storage_path('fonts\THSarabun Bold.ttf') }}) format("truetype");
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'TH';
            font-size: 1.2rem;
        }

        .header {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .text-center {
            text-align: center;

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible;
        }

        /* @page {
            size: A4;
            padding: 0px;
        } */

        /* @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }
        } */

        .mb-0,
        .my-0 {
            margin-bottom: -10 !important;
        }

        .mb-2,
        .my-2 {
            margin-bottom: 0.5rem !important;
        }

        #customers {
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 0px;
            vertical-align: middle;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            text-align: center;
            vertical-align: middle;
        }

    </style>
</head>

@php
$n = 100;
@endphp

<body>
    <div class="text-center">สรุปผลการสัมภาษณ์{{ $dorm->name }}</div>
    <div class="text-center mb-2">ประจำปีการศึกษา {{ $year->year + 543 }}</div>
    <table id="customers">
        <thead>
            <tr>
                <th class="align-middle">รหัสนักศึกษา</th>
                <th class="align-middle">ชื่อ - สกุล</th>
                <th class="align-middle">คณะ</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{ $item['username'] }}</td>
                    <td class="text-center">{{ $item['name'] }}</td>
                    <td class="text-center">{{ $item['faculty'] }}</td>
                    @if ($item['status'] == 1)
                        <td class="text-center text-success">ผ่าน</td>
                    @else
                        <td class="text-center text-danger">ไม่ผ่าน</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
