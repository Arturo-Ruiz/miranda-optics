<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fórmula Óptica - {{ $patient->full_name }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 30px 40px;
            color: #333;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #C0A060;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .logo-cell {
            vertical-align: top;
            padding-right: 20px;
        }

        .logo-img {
            height: 90px;
            width: auto;
        }

        .company-info-cell {
            vertical-align: top;
            text-align: right;
        }

        .company-name {
            font-family: 'Times New Roman', Times, serif;
            font-size: 32px;
            font-weight: bold;
            color: #33691E;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 5px 0;
            line-height: 1;
        }

        .company-slogan {
            font-family: 'Helvetica', sans-serif;
            font-size: 9px;
            color: #C0A060;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .contact-details {
            font-size: 10px;
            color: #555;
            line-height: 1.5;
            font-family: 'Helvetica', sans-serif;
        }

        .contact-row {
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        
        .icon-img {
            width: 12px;
            height: 12px;
            margin-right: 4px;
            vertical-align: middle;
            display: inline-block;
        }

        .auth-date {
            margin-top: 10px;
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }

        /* PACIENTE */
        .patient-box {
            margin-bottom: 25px;
            padding: 10px 15px;
            background-color: #f8fcf5;
            border-radius: 8px;
            border: 1px solid #e0e6d8;
        }

        .info-table {
            width: 100%;
        }

        .info-label {
            font-size: 8px;
            color: #888;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 13px;
            color: #222;
            font-weight: bold;
            display: block;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
            margin-bottom: 5px;
            min-height: 16px;
        }

        .patient-name-value {
            font-size: 16px;
            color: #33691E;
            text-transform: uppercase;
            border-bottom-color: #689F38;
        }

        /* SECCIONES TITULARES */
        .section-header {
            background-color: #33691E;
            color: white;
            padding: 6px 15px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 15px 15px 0 0;
            display: inline-block;
            margin-bottom: 0;
            letter-spacing: 1px;
        }
        
        .full-width-line {
            height: 2px;
            background-color: #33691E;
            margin-top: -2px;
            margin-bottom: 15px;
        }

        /* TABLAS PRINCIPALES */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table th {
            background-color: #f1f8e9;
            color: #33691E;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 5px;
            border: 1px solid #ccc;
        }

        .main-table td {
            text-align: center;
            padding: 12px 5px;
            font-size: 14px;
            font-weight: bold;
            color: #444;
            border: 1px solid #ccc;
        }

        /* OD/OI INDICATORS */
        .eye-circle-text {
            font-size: 12px;
            font-weight: 900;
            color: #33691E;
            background: #e8f5e9;
            padding: 5px 8px;
            border-radius: 20px;
            border: 1px solid #33691E;
        }
        
        .eye-circle-text.oi {
            color: #C0A060;
            background: #fff8e1;
            border-color: #C0A060;
        }

        /* VISION DISTANTE/CERCANA */
        .vision-container {
            width: 100%;
            border-collapse: separate;
            border-spacing: 15px 0;
            margin-bottom: 20px;
            margin-left: -8px;
        }

        .vision-col {
            vertical-align: top;
            width: 50%;
        }
        
        .sub-header {
            background-color: #689F38;
            color: white;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px;
            border-radius: 6px 6px 0 0;
        }
        
        .sub-header.near {
            background-color: #C0A060;
        }

        .vision-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            border-top: none;
        }

        .vision-table th {
            background-color: #f9f9f9;
            color: #555;
            font-size: 8px;
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #eee;
        }

        .vision-table td {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        /* OPCIONES (Ovals style like the image) */
        .options-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px 10px;
            margin-bottom: 20px;
        }
        
        .option-oval {
            border: 1px solid #666;
            border-radius: 50px;
            padding: 5px 10px;
            text-align: center;
            font-size: 10px;
            color: #444;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
        }
        
        .option-oval.selected {
            border: 2px solid #33691E;
            background-color: #f1f8e9;
            color: #33691E;
        }
        
        .x-mark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            font-weight: bold;
            color: #33691E;
        }

        /* OBSERVACIONES */
        .obs-container {
            border: 1px solid #C0A060;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            min-height: 80px;
        }
        
        .obs-title {
            font-size: 10px;
            font-weight: bold;
            color: #C0A060;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .obs-text {
            font-size: 12px;
            color: #444;
            font-style: italic;
        }

        /* FOOTER */
        .footer-line {
            margin-top: 90px;
            text-align: center;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            border-top: 1px solid #000;
            padding-top: 5px;
            font-size: 8px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Compact Mode for Double Print (Landscape) to fit height */
        .compact-mode .header-table { margin-bottom: 10px; padding-bottom: 5px; }
        .compact-mode .patient-box { margin-bottom: 10px; padding: 5px 10px; }
        .compact-mode .info-value { margin-bottom: 2px; font-size: 11px; }
        .compact-mode .section-header { padding: 4px 10px; font-size: 10px; }
        .compact-mode .full-width-line { margin-bottom: 10px; }
        .compact-mode .main-table { margin-bottom: 10px; }
        .compact-mode .main-table td { padding: 6px 4px; font-size: 12px; }
        .compact-mode .main-table th { padding: 6px 4px; font-size: 8px; }
        .compact-mode .options-grid { margin-bottom: 10px; border-spacing: 2px 5px; }
        .compact-mode .option-oval { padding: 3px 6px; font-size: 9px; }
        .compact-mode .vision-container { margin-bottom: 10px; }
        .compact-mode .vision-table td { padding: 5px; font-size: 10px; }
        .compact-mode .vision-table th { padding: 3px; font-size: 7px; }
        .compact-mode .obs-container { padding: 8px; min-height: 40px; margin-top: 5px; }
        .compact-mode .footer-line { margin-top: 55px; }
        .compact-mode .logo-img { height: 60px; }
        .compact-mode .company-name { font-size: 24px; }
    </style>
</head>
</head>
@php
    $copies = $copies ?? 1;
@endphp
<body style="{{ $copies > 1 ? 'padding: 15px 20px;' : '' }}">

@if($copies > 1)
    {{-- Side by Side Layout (Landscape) --}}
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td width="50%" style="vertical-align: top; padding-right: 25px; border-right: 1px dashed #666;">
                <div class="compact-mode">
                    @include('patients.partials.pdf-content')
                </div>
            </td>
            <td width="50%" style="vertical-align: top; padding-left: 25px;">
                <div class="compact-mode">
                    @include('patients.partials.pdf-content')
                </div>
            </td>
        </tr>
    </table>
@else
    {{-- Single Layout (Portrait) --}}
    @include('patients.partials.pdf-content')
@endif

</body>
</html>