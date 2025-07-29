<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Table</title>
    <style>
        @page {
            margin: 40mm 15mm 40mm 20mm;
            size: A4;
            @top-center {
                content: element(header);
            }
            @bottom-center {
                content: element(footer);
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
            /* table-layout: fixed; */
        }
        th, td {
            padding: 10px;
            border: 1px solid #000;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            box-sizing: border-box;
        }
        th {
            background-color: #f4f4f4;
        }
        #details td {
            border: none;
            font-weight: bold;
        }
        #wm {
            position: fixed;
            top: -40mm;
            left: -20mm;
            bottom: -40mm;
            right: -20mm;
            background-image: url({{ public_path('assets/images/cover-recap.jpg') }});
            background-repeat: no-repeat;
            background-size: contain;
            z-index: -1;
        }
        #header {
            position: running(header);
        }
        #footer {
            position: running(footer);
        }
        .cover {
            display: flex;
            justify-content: center;
            text-align: center;
            page-break-after: always;
            margin-top: 80mm;
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 0;
            font-size: small;
        }
        .content #details {
            font-size: 14pt;
        }
    </style>
</head>
<body>
    <div id="wm"></div>
    <div class="cover">
        <h2>LAPORAN SEMENTARA SAFETY PATROL</h2>
        <h2>PT. Rekaindo Global Jasa</h2>
    </div>
    <div class="content">
        <table id="details">
            <tbody>
                <tr>
                    <td>Perusahaan</td>
                    <td>:</td>
                    <td>PT REKAINDO</td>
                </tr>
                <tr>
                    <td>Pelaksanaan Safety Patrol</td>
                    <td>:</td>
                    <td>{{$safetyPatrolRecap->from_date}} - {{$safetyPatrolRecap->to_date}}</td>
                </tr>
                <tr style="vertical-align: top">
                    <td style="vertical-align: top">Inspector</td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top">
                        @if (count($workers) > 1)
                            <ul style="list-style-type: none; padding: 0; margin: 0">
                                @foreach ($workers as $worker)
                                    <li>- {{ $worker->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            @foreach ($workers as $worker)
                                {{ $worker->name }}
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Temuan</td>
                    <td>:</td>
                    <td>{{ $safetyPatrols->count() }}</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top: 20px">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="23%">Deskripsi Temuan</th>
                    <th width="18%">Validasi Temuan</th>
                    <th width="14%">Lokasi</th>
                    <th width="18%">Tanggal Pemeriksaan</th>
                    <th width="17%">Status Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @if ($safetyPatrols->count() > 0)
                    @foreach ($safetyPatrols as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->findings_description ?? '-' }}</td>
                            <td>{{ is_null($item->is_valid_entry) ? 'Temuan Belum Dikonfirmasi' : ($item->is_valid_entry ? ($item->hasMemo() ? 'Temuan Dievaluasi' : 'Temuan Dikonfirmasi') : 'Temuan Ditolak') }}</td>
                            <td>{{ $item->location ?? '-' }}</td>
                            <td>{{ $item->checkup_date ?? '-' }}</td>
                            <td>{{ $item->hasMemo() ? 'Memerlukan Evaluasi' : 'Belum Ditindak Lanjut' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" align="center">Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>

