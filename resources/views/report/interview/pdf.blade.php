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
    <div class="text-center">คะแนนการสัมภาษณ์{{ $dorm->name }}</div>
    <div class="text-center mb-2">ประจำปีการศึกษา {{ $year->year + 543 }}</div>
    <table id="customers">
        <thead>
            <tr>
                <th rowspan="3" class="align-middle">รหัสนักศึกษา</th>
                <th rowspan="3" class="align-middle">ชื่อ - สกุล</th>
                <th rowspan="3" class="align-middle">คณะ</th>
                <th colspan="4">การมีส่วนร่วมในกิจกรรม</th>
                <th rowspan="3" class="align-middle">ความจำเป็นตามฐานะทางเศรษฐกิจ (20)</th>
                <th rowspan="3" class="align-middle">ความประพฤติ (20)</th>
                <th rowspan="3" class="align-middle">รวม (100)</th>
                <th rowspan="3" class="align-middle">สถานะ</th>
            </tr>
            <tr class="text-center">
                <th colspan="2">กิจกรรมหอพัก (40)</th>
                <th colspan="2">กิจกรรมคณะ / มหาวิทยาลัย (20)</th>
            </tr>
            <tr class="text-center">
                <th>ร้อยละการเข้าร่วมกิจกรรม</th>
                <th>คะแนนที่ได้รับ</th>
                <th>หน่วยกิจกรรม</th>
                <th>คะแนนที่ได้</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="text-center">{{ $item['username'] }}</td>
                    <td class="text-center">{{ $item['name'] }}</td>
                    <td class="text-center">{{ $item['faculty'] }}</td>
                    <td class="text-center">{{ $item['percent'] }}</td>
                    <td class="text-center">{{ $item['dorm_score'] }}</td>
                    <td class="text-center">{{ $item['credit'] }}</td>
                    <td class="text-center">{{ $item['kku_score'] }}</td>
                    <td class="text-center">{{ $item['family_score'] }}</td>
                    <td class="text-center">{{ $item['behavior_score'] }}</td>
                    <td class="text-center">
                        {{ $item['dorm_score'] + $item['kku_score'] + $item['family_score'] + $item['behavior_score'] }}
                    </td>
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
