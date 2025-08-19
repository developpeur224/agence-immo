<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de contact</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #2c5282 0%, #3182ce 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .email-body {
            padding: 40px;
        }
        .email-footer {
            background-color: #edf2f7;
            color: #718096;
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }
        .property-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
        }
        .btn-primary {
            display: inline-block;
            padding: 14px 32px;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2c5282;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 20px 0;
        }
        .info-item {
            padding: 16px;
            background-color: #f8fafc;
            border-radius: 6px;
            border-left: 4px solid #3182ce;
        }
        .client-info {
            background: linear-gradient(135deg, #ebf4ff 0%, #e6fffa 100%);
            padding: 25px;
            border-radius: 8px;
            margin: 30px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-available {
            background-color: #48bb78;
            color: white;
        }
        .status-sold {
            background-color: #f56565;
            color: white;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%);
            margin: 30px 0;
        }
        .action-links {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .action-link {
            color: #3182ce;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .action-link:hover {
            color: #2c5282;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- En-tête minimaliste -->
        <div class="email-header">
            <h1 style="margin: 0; font-size: 28px; font-weight: 300;">Nouveau contact</h1>
            <p style="margin: 10px 0 0; opacity: 0.9; font-size: 16px;">Intérêt pour votre propriété</p>
        </div>

        <!-- Corps de l'email -->
        <div class="email-body">
            <h2 style="margin: 0 0 20px; font-size: 24px; color: #2d3748;">Bonjour,</h2>
            <p style="margin: 0 0 30px; color: #718096; font-size: 16px;">
                Un prospect souhaite obtenir des informations supplémentaires sur cette propriété :
            </p>

            <!-- Carte du bien -->
            <div class="property-card">
                <h3 style="margin: 0 0 10px; font-size: 20px; color: #2d3748;">{{ $property->title }}</h3>
                <p style="margin: 0 0 20px; color: #718096; font-size: 14px;">Référence : #{{ $property->id }}</p>
                
                <div class="info-grid">
                    <div class="info-item">
                        <strong style="display: block; color: #4a5568; margin-bottom: 8px;">📍 Adresse</strong>
                        <span style="color: #718096;">{{ $property->address }}, {{ $property->postal_code }} {{ $property->city }}</span>
                    </div>
                    <div class="info-item">
                        <strong style="display: block; color: #4a5568; margin-bottom: 8px;">💰 Prix</strong>
                        <span style="color: #718096; font-weight: 600;">{{ number_format($property->price, 0, ',', ' ') }} €</span>
                    </div>
                    <div class="info-item">
                        <strong style="display: block; color: #4a5568; margin-bottom: 8px;">📐 Surface</strong>
                        <span style="color: #718096;">{{ $property->surface }} m²</span>
                    </div>
                    <div class="info-item">
                        <strong style="display: block; color: #4a5568; margin-bottom: 8px;">🚪 Composition</strong>
                        <span style="color: #718096;">{{ $property->rooms }} pièces • {{ $property->bedrooms }} chambres</span>
                    </div>
                </div>

                <span class="status-badge status-{{ $property->sold ? 'sold' : 'available' }}">
                    {{ $property->sold ? 'Vendu' : 'Disponible' }}
                </span>
            </div>

            <div class="divider"></div>

            <!-- Informations du client -->
            <div class="client-info">
                <h3 style="margin: 0 0 20px; font-size: 18px; color: #2d3748;">📞 Prospect</h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                    <div>
                        <strong style="display: block; color: #4a5568; font-size: 14px;">Nom complet</strong>
                        <span style="color: #718096;">{{ $contactData['firstname'] }} {{ $contactData['lastname'] }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #4a5568; font-size: 14px;">Email</strong>
                        <span style="color: #718096;">{{ $contactData['email'] }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #4a5568; font-size: 14px;">Téléphone</strong>
                        <span style="color: #718096;">{{ $contactData['phone'] ?? 'Non renseigné' }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #4a5568; font-size: 14px;">Date</strong>
                        <span style="color: #718096;">{{ now()->format('d/m/Y • H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Message du client -->
            <div style="background-color: #f8fafc; padding: 25px; border-radius: 8px;">
                <h3 style="margin: 0 0 15px; font-size: 16px; color: #4a5568;">✉️ Message</h3>
                <p style="margin: 0; color: #718096; font-style: italic; line-height: 1.6;">
                    "{{ $contactData['message'] }}"
                </p>
            </div>

            <!-- Actions principales -->
            <div style="text-align: center; margin: 40px 0 20px;">
                <a href="{{ route('admin.property.edit', $property) }}" class="btn-primary">
                    Voir le bien dans l'admin
                </a>
                
                <div class="action-links">
                    <a href="mailto:{{ $contactData['email'] }}" class="action-link">
                        ✉️ Répondre
                    </a>
                    @if($contactData['phone'])
                    <a href="tel:{{ $contactData['phone'] }}" class="action-link">
                        📞 Appeler
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pied de page minimal -->
        <div class="email-footer">
            <p style="margin: 0 0 10px;">© {{ date('Y') }} {{ config('app.name') }}</p>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">
                Email automatique • <a href="{{ config('app.url') }}" style="color: #3182ce; text-decoration: none;">{{ config('app.url') }}</a>
            </p>
        </div>
    </div>
</body>
</html>