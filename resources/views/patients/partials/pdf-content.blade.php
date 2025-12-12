    <!-- Header con Contact Info -->
    <table class="header-table">
        <tr>
            <td class="logo-cell" width="25%">
                <img src="file://{{ public_path('img/logo.png') }}" class="logo-img">
            </td>
            <td class="company-info-cell" width="75%">
                <div class="company-name">ÓPTICA MIRANDA</div>
                <div class="company-slogan">Cuidando tu visión con excelencia</div>
                
                <div class="contact-details">
                    <div class="contact-row">
                        <img src="file://{{ public_path('img/icon-location.png') }}" class="icon-img" alt="location">
                        Av. Principal de Lecheria, Estado Anzoategui
                    </div>
                    <div class="contact-row">
                        <img src="file://{{ public_path('img/icon-phone.png') }}" class="icon-img" alt="phone">
                        0424-8234423 / 0281-2868152
                    </div>
                    <div class="contact-row">
                        <img src="file://{{ public_path('img/icon-email.png') }}" class="icon-img" alt="email">
                        contacto@opticamiranda.com &nbsp;&nbsp; 
                        <img src="file://{{ public_path('img/icon-instagram.png') }}" class="icon-img" alt="instagram">
                        @opticamiranda
                    </div>
                    <div class="contact-row">
                        <strong>RIF:</strong> J-30681502-0
                    </div>
                </div>
                
                <div class="auth-date">
                    Fecha: {{ now()->format('d/m/Y') }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Datos del Paciente -->
    <div class="patient-box">
        <table class="info-table">
            <tr>
                <td width="60%">
                    <span class="info-label">Paciente</span>
                    <span class="info-value patient-name-value">{{ $patient->full_name }}</span>
                </td>
                <td width="40%">
                    <span class="info-label">Cédula de Identidad</span>
                    <span class="info-value">{{ $patient->id_card }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="info-label">Ocupación</span>
                    <span class="info-value" style="border:none; margin:0;">{{ $patient->occupation ?? 'No registrada' }}</span>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%">
                                <span class="info-label">Edad</span>
                                <span class="info-value" style="border:none; margin:0;">{{ $patient->age }} Años</span>
                            </td>
                            <td width="50%">
                                <span class="info-label">Teléfono</span>
                                <span class="info-value" style="border:none; margin:0;">{{ $patient->phone }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Fórmula Refractiva -->
    <div class="section-header">Fórmula Refractiva</div>
    <div class="full-width-line"></div>
    
    <table class="main-table">
        <thead>
            <tr>
                <th width="10%"></th>
                <th width="15%">ESF</th>
                <th width="15%">CIL</th>
                <th width="15%">EJE</th>
                <th width="15%">ADD</th>
                <th width="15%">DPN</th>
                <th width="15%">ALT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="eye-circle-text">OD</span></td>
                <td>{{ $patient->optical_formula['formula']['od']['esf'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['od']['cil'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['od']['eje'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['od']['add'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['od']['dpn'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['od']['alt'] ?? '' }}</td>
            </tr>
            <tr>
                <td><span class="eye-circle-text oi">OI</span></td>
                <td>{{ $patient->optical_formula['formula']['oi']['esf'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['oi']['cil'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['oi']['eje'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['oi']['add'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['oi']['dpn'] ?? '' }}</td>
                <td>{{ $patient->optical_formula['formula']['oi']['alt'] ?? '' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Opciones (Estilo Ovalado) -->
    @php $opts = $patient->optical_formula['options'] ?? []; @endphp
    <table class="options-grid">
        <tr>
            <td width="10%" style="font-size:10px; font-weight:bold;">TIPO:</td>
            <td width="30%">
                <div class="option-oval {{ ($opts['vs'] ?? false) ? 'selected' : '' }}">
                    Vision Sencilla
                </div>
            </td>
            <td width="30%">
                <div class="option-oval {{ ($opts['bif'] ?? false) ? 'selected' : '' }}">
                    Bifocal
                </div>
            </td>
             <td width="30%">
                <div class="option-oval {{ ($opts['prog'] ?? false) ? 'selected' : '' }}">
                    Progresivo
                </div>
            </td>
        </tr>
        <tr>
            <td style="font-size:10px; font-weight:bold;">MAT:</td>
             <td>
                <div class="option-oval {{ ($opts['poly'] ?? false) ? 'selected' : '' }}">
                    Poly
                </div>
            </td>
            <td>
                <div class="option-oval {{ ($opts['ar'] ?? false) ? 'selected' : '' }}">
                    AR
                </div>
            </td>
            <td>
                <div class="option-oval {{ ($opts['foto'] ?? false) ? 'selected' : '' }}">
                    Foto
                </div>
            </td>
        </tr>
         <tr>
            <td style="font-size:10px; font-weight:bold;">TRAT:</td>
            <td>
                <div class="option-oval {{ ($opts['tallado'] ?? false) ? 'selected' : '' }}">
                    Tallado
                </div>
            </td>
            <td>
                <div class="option-oval {{ ($opts['terminado'] ?? false) ? 'selected' : '' }}">
                    Terminado
                </div>
            </td>
             <td>
                <div class="option-oval {{ ($opts['blue_block'] ?? false) ? 'selected' : '' }}">
                    Blue Block
                </div>
            </td>
        </tr>
    </table>

    <!-- Visión -->
    <table class="vision-container">
        <tr>
            <td class="vision-col">
                <div class="sub-header">Visión Lejana</div>
                <table class="vision-table">
                    <tr>
                        <th width="20%"></th>
                        <th width="40%">AV.SC</th>
                        <th width="40%">AV.CC</th>
                    </tr>
                    <tr>
                        <td><strong>OD</strong></td>
                        <td>{{ $patient->optical_formula['vision_lejana']['od']['av_sc'] ?? '' }}</td>
                        <td>{{ $patient->optical_formula['vision_lejana']['od']['av_cc'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>OI</strong></td>
                        <td>{{ $patient->optical_formula['vision_lejana']['oi']['av_sc'] ?? '' }}</td>
                        <td>{{ $patient->optical_formula['vision_lejana']['oi']['av_cc'] ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td class="vision-col">
                <div class="sub-header near">Visión Cercana</div>
                <table class="vision-table">
                    <tr>
                        <th width="20%"></th>
                        <th width="40%">AV.SC</th>
                        <th width="40%">AV.CC</th>
                    </tr>
                    <tr>
                        <td><strong>OD</strong></td>
                        <td>{{ $patient->optical_formula['vision_cercana']['od']['av_sc'] ?? '' }}</td>
                        <td>{{ $patient->optical_formula['vision_cercana']['od']['av_cc'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>OI</strong></td>
                        <td>{{ $patient->optical_formula['vision_cercana']['oi']['av_sc'] ?? '' }}</td>
                        <td>{{ $patient->optical_formula['vision_cercana']['oi']['av_cc'] ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Observaciones -->
    <div class="obs-container">
        <div class="obs-title">Observaciones:</div>
        <div class="obs-text">
            {{ $patient->optical_formula['observation'] ?? 'Ninguna observación registrada.' }}
        </div>
    </div>

    <!-- Firma -->
    <div class="footer-line">
        Optometrista / Especialista
    </div>
