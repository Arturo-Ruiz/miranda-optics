<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórmula Óptica - {{ $patient->full_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: white;
        }

        .prescription-container {
            width: 100%;
            max-width: 600px;
            height: 50vh;
            margin: 0 auto;
            padding: 20px;
            border: 3px solid #6B8E23;
            border-radius: 15px;
            background: linear-gradient(to bottom, #f0f9f0 0%, #ffffff 100%);
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, #6B8E23 0%, #8FBC8F 100%);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            height: 60px;
            width: auto;
        }

        .company-name {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .contact-info {
            color: white;
            font-size: 11px;
            text-align: right;
            line-height: 1.4;
        }

        .patient-info {
            background: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 2px solid #6B8E23;
        }

        .patient-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .info-field {
            font-size: 13px;
        }

        .info-label {
            font-weight: bold;
            color: #6B8E23;
        }

        .formula-title {
            background: linear-gradient(135deg, #6B8E23 0%, #8FBC8F 100%);
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .formula-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            border: 2px solid #6B8E23;
        }

        .formula-table th {
            background: #6B8E23;
            color: white;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #556B2F;
        }

        .formula-table td {
            padding: 8px;
            text-align: center;
            border: 1px solid #6B8E23;
            font-size: 13px;
        }

        .formula-table tr:first-child td:first-child {
            background: #8FBC8F;
            color: white;
            font-weight: bold;
        }

        .formula-table tr:last-child td:first-child {
            background: #8FBC8F;
            color: white;
            font-weight: bold;
        }

        .options-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 12px;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            border: 2px solid #6B8E23;
            border-radius: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .checkbox.checked::after {
            content: "✓";
            color: #6B8E23;
            font-weight: bold;
            font-size: 14px;
        }

        .vision-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 12px;
        }

        .vision-box {
            border: 2px solid #6B8E23;
            border-radius: 8px;
            overflow: hidden;
        }

        .vision-title {
            background: #6B8E23;
            color: white;
            text-align: center;
            padding: 6px;
            font-weight: bold;
            font-size: 12px;
        }

        .vision-table {
            width: 100%;
            border-collapse: collapse;
        }

        .vision-table th {
            background: #8FBC8F;
            color: white;
            padding: 6px;
            font-size: 11px;
            border: 1px solid #6B8E23;
        }

        .vision-table td {
            padding: 6px;
            text-align: center;
            border: 1px solid #6B8E23;
            font-size: 12px;
        }

        .vision-table tr td:first-child {
            background: #f0f9f0;
            font-weight: bold;
        }

        .observation-section {
            border: 2px solid #6B8E23;
            border-radius: 8px;
            padding: 10px;
            min-height: 60px;
            background: white;
        }

        .observation-title {
            color: #6B8E23;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .observation-text {
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            color: #6B8E23;
            font-size: 11px;
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
                padding: 10px;
            }

            .prescription-container {
                max-width: 100%;
                height: 50vh;
                page-break-after: always;
                border: 3px solid #6B8E23;
            }

            @page {
                size: letter;
                margin: 0;
            }
        }

        @media screen {
            .no-print {
                text-align: center;
                margin: 20px 0;
            }

            .print-button {
                background: #6B8E23;
                color: white;
                border: none;
                padding: 12px 30px;
                font-size: 16px;
                border-radius: 8px;
                cursor: pointer;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }

            .print-button:hover {
                background: #556B2F;
            }
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="print-button" onclick="window.print()">🖨️ Imprimir Fórmula</button>
    </div>

    <div class="prescription-container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <img src="{{ asset('img/logo.png') }}" alt="Miranda Óptica" class="logo">
                <div class="company-name">ÓPTICA MIRANDA</div>
            </div>
            <div class="contact-info">
                Sistema de Gestión Óptica<br>
                {{ now()->format('d/m/Y') }}
            </div>
        </div>

        <!-- Patient Info -->
        <div class="patient-info">
            <div class="patient-info-grid">
                <div class="info-field">
                    <span class="info-label">Paciente:</span> {{ $patient->full_name }}
                </div>
                <div class="info-field">
                    <span class="info-label">Edad:</span> {{ $patient->age }} años
                </div>
                <div class="info-field">
                    <span class="info-label">Cédula:</span> {{ $patient->id_card }}
                </div>
                <div class="info-field">
                    <span class="info-label">Teléfono:</span> {{ $patient->phone }}
                </div>
                @if($patient->occupation)
                <div class="info-field">
                    <span class="info-label">Ocupación:</span> {{ $patient->occupation }}
                </div>
                @endif
            </div>
        </div>

        @if($patient->optical_formula)
            <!-- Formula Title -->
            <div class="formula-title">FÓRMULA</div>

            <!-- Main Formula Table -->
            @if(isset($patient->optical_formula['formula']))
            <table class="formula-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ESF</th>
                        <th>CIL</th>
                        <th>EJE</th>
                        <th>ADD</th>
                        <th>DPN</th>
                        <th>ALT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>OD</td>
                        <td>{{ $patient->optical_formula['formula']['od']['esf'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['od']['cil'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['od']['eje'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['od']['add'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['od']['dpn'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['od']['alt'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>OI</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['esf'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['cil'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['eje'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['add'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['dpn'] ?? '-' }}</td>
                        <td>{{ $patient->optical_formula['formula']['oi']['alt'] ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
            @endif

            <!-- Options -->
            @if(isset($patient->optical_formula['options']))
            <div class="options-section">
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['vs'] ?? false) ? 'checked' : '' }}"></span>
                    <span>VS</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['poly'] ?? false) ? 'checked' : '' }}"></span>
                    <span>POLY</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['tallado'] ?? false) ? 'checked' : '' }}"></span>
                    <span>TALLADO</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['bif'] ?? false) ? 'checked' : '' }}"></span>
                    <span>BIF</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['ar'] ?? false) ? 'checked' : '' }}"></span>
                    <span>AR</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['terminado'] ?? false) ? 'checked' : '' }}"></span>
                    <span>TERMINADO</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['prog'] ?? false) ? 'checked' : '' }}"></span>
                    <span>PROG</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['foto'] ?? false) ? 'checked' : '' }}"></span>
                    <span>FOTO</span>
                </div>
                <div class="option-item">
                    <span class="checkbox {{ ($patient->optical_formula['options']['blue_block'] ?? false) ? 'checked' : '' }}"></span>
                    <span>BLUE BLOCK</span>
                </div>
            </div>
            @endif

            <!-- Vision Section -->
            <div class="vision-section">
                <!-- Visión Lejana -->
                @if(isset($patient->optical_formula['vision_lejana']))
                <div class="vision-box">
                    <div class="vision-title">VISIÓN LEJANA</div>
                    <table class="vision-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>AV.SC</th>
                                <th>AV.CC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OD</td>
                                <td>{{ $patient->optical_formula['vision_lejana']['od']['av_sc'] ?? '-' }}</td>
                                <td>{{ $patient->optical_formula['vision_lejana']['od']['av_cc'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td>{{ $patient->optical_formula['vision_lejana']['oi']['av_sc'] ?? '-' }}</td>
                                <td>{{ $patient->optical_formula['vision_lejana']['oi']['av_cc'] ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Visión Cercana -->
                @if(isset($patient->optical_formula['vision_cercana']))
                <div class="vision-box">
                    <div class="vision-title">VISIÓN CERCANA</div>
                    <table class="vision-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>AV.SC</th>
                                <th>AV.CC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OD</td>
                                <td>{{ $patient->optical_formula['vision_cercana']['od']['av_sc'] ?? '-' }}</td>
                                <td>{{ $patient->optical_formula['vision_cercana']['od']['av_cc'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td>{{ $patient->optical_formula['vision_cercana']['oi']['av_sc'] ?? '-' }}</td>
                                <td>{{ $patient->optical_formula['vision_cercana']['oi']['av_cc'] ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Observation -->
            @if(isset($patient->optical_formula['observation']) && $patient->optical_formula['observation'])
            <div class="observation-section">
                <div class="observation-title">Observación:</div>
                <div class="observation-text">{{ $patient->optical_formula['observation'] }}</div>
            </div>
            @endif

            <div class="footer">
                Óptica Miranda - Cuidando tu visión
            </div>
        @else
            <div style="text-align: center; padding: 40px; color: #6B8E23;">
                <p style="font-size: 18px;">Este paciente no tiene fórmula óptica registrada.</p>
            </div>
        @endif
    </div>
</body>
</html>
