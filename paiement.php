<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omnes_immobilier";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID de la propriété est défini dans l'URL
if (isset($_GET['id_propriete']) && !empty($_GET['id_propriete'])) {
    $id_propriete = intval($_GET['id_propriete']); // Assurez-vous de valider et de sécuriser cette entrée

    // Récupérer les informations de la propriété
    $sql = "SELECT Adresse, Ville, Prix, url_image FROM proprietes WHERE ID_propriete = $id_propriete";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les informations de la propriété
        $row = $result->fetch_assoc();
        $adresse = $row['Adresse'];
        $ville = $row['Ville'];
        $prix = $row['Prix'];
        $image = $row['url_image'];
        $frais_agence = $prix * 0.10;
        $total = $prix + $frais_agence;
        $image_path = $image; // Chemin direct vers l'image
    } else {
        echo "Propriété non trouvée.";
        exit;
    }
} else {
    echo "ID de propriété non spécifié.";
    exit;
}

$conn->close();

// Traitement du formulaire
$message = "";
$is_success = null; // Pour savoir si la transaction a réussi ou échoué
$missing_fields = [];
$assurance_selected = isset($_POST['assurance']) && $_POST['assurance'] == 'yes';
$credit_selected = isset($_POST['credit']) && $_POST['credit'] == 'yes';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier les champs manquants
    $required_fields = ['name', 'address1', 'city', 'postal_code', 'country', 'phone', 'card_number', 'card_name', 'expiry_month', 'expiry_year', 'security_code'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (!empty($missing_fields)) {
        $message = "Erreur : Vous n'avez pas rempli toutes les cases du formulaire, ceci est obligatoire. Veuillez réessayer.";
        $is_success = false;
    } else {
        // Simuler une attente de 1,5 secondes
        usleep(1500000); // 1.5 secondes en microsecondes

        // Déterminer aléatoirement si le paiement échoue ou réussit (2 chances sur 3 de réussir)
        if (rand(0, 2) < 2) {
            // Réussite du paiement
            header("Location: paiement_complété.php");
            exit;
        } else {
            // Échec du paiement
            $message = "Erreur : Fonds insuffisants. Veuillez réessayer.";
            $is_success = false;
        }
    }
}

$total_with_assurance = $total;
if ($assurance_selected) {
    $total_with_assurance += $total * 0.02; // Ajouter 2% du total pour l'assurance immobilier
}

$mensualite = 0;
if ($credit_selected) {
    $mensualite = ($total_with_assurance / 48) * 1.01; // Ajouter 1% du prix par mois
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de Paiement</title>
    <link rel="stylesheet" type="text/css" href="paiement.css">
    <script>
        function updateTotalWithAssuranceAndCredit() {
            const totalElement = document.getElementById('total');
            const totalWithAssuranceElement = document.getElementById('total-with-assurance');
            const assuranceCheckbox = document.getElementById('assurance');
            const creditCheckbox = document.getElementById('credit');
            const mensualiteElement = document.getElementById('mensualite');

            let total = parseFloat(totalElement.getAttribute('data-total'));
            if (assuranceCheckbox.checked) {
                total += total * 0.02; // Ajouter 2% du total pour l'assurance immobilier
            }

            totalWithAssuranceElement.textContent = '€' + total.toLocaleString('fr-FR', { minimumFractionDigits: 0 });

            if (creditCheckbox.checked) {
                let mensualite = (total / 48) * 1.01; // Ajouter 1% du prix par mois
                mensualiteElement.textContent = '€' + mensualite.toLocaleString('fr-FR', { minimumFractionDigits: 0 });
            } else {
                mensualiteElement.textContent = '';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const assuranceCheckbox = document.getElementById('assurance');
            const creditCheckbox = document.getElementById('credit');

            assuranceCheckbox.addEventListener('change', function() {
                updateTotalWithAssuranceAndCredit();
                const assuranceInfo = document.getElementById('assurance-info');
                if (assuranceCheckbox.checked) {
                    assuranceInfo.style.display = 'block';
                } else {
                    assuranceInfo.style.display = 'none';
                }
            });

            creditCheckbox.addEventListener('change', function() {
                updateTotalWithAssuranceAndCredit();
                const creditInfo = document.getElementById('credit-info');
                if (creditCheckbox.checked) {
                    creditInfo.style.display = 'block';
                } else {
                    creditInfo.style.display = 'none';
                }
            });

            updateTotalWithAssuranceAndCredit(); // Initial call to set the total with assurance if the checkbox is checked
        });

        function simulateLoading() {
            document.getElementById('loading').style.display = 'block';
            setTimeout(function() {
                document.getElementById('paymentForm').submit();
            }, 1500);
        }

        function closePopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }

        function showErrorPopup() {
            document.getElementById('errorPopup').style.display = 'block';
        }

        window.onload = function() {
            <?php if ($is_success === false): ?>
                showErrorPopup();
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <main>
        <div class="left-column">
            <div class="property-info">
                <h2>Informations de la Propriété</h2>
                <?php if (file_exists($image_path)) { ?>
                    <img src="<?php echo $image_path; ?>" alt="Image de la propriété" class="property-image">
                <?php } else { ?>
                    <p>Image non disponible : <?php echo $image_path; ?></p>
                <?php } ?>
                <p><strong>Adresse :</strong> <?php echo $adresse; ?></p>
                <p><strong>Ville :</strong> <?php echo $ville; ?></p>
                <p><strong>Prix :</strong> €<?php echo number_format($prix, 0, ',', ' '); ?></p>
                <p><strong>Frais de l'agence :</strong> €<?php echo number_format($frais_agence, 0, ',', ' '); ?></p>
                <p><strong>Total :</strong> €<?php echo number_format($total, 0, ',', ' '); ?></p>
                <input type="hidden" id="total" data-total="<?php echo $total; ?>">
                <label for="assurance">Assurance Immobilière proposée par Omnes Immobilier :</label>
                <input type="checkbox" id="assurance" name="assurance" value="yes" form="paymentForm" <?php echo $assurance_selected ? 'checked' : ''; ?>>
                <div id="assurance-info" style="display: <?php echo $assurance_selected ? 'block' : 'none'; ?>;">
                    <h3>Agence d'Assurance</h3>
                    <p><strong>Nom:</strong> AssureTout Immobilier</p>
                    <p><strong>Email:</strong> contact@assuretout.com</p>
                    <p><strong>Téléphone:</strong> 01 24 73 73 73</p>
                    <p><strong>Personne à contacter:</strong> Jean Darme</p>
                </div>
                <p><strong>Total avec Assurance :</strong> <span id="total-with-assurance">€<?php echo number_format($total_with_assurance, 0, ',', ' '); ?></span></p>
                <label for="credit">Prêt Immobilier :</label>
                <input type="checkbox" id="credit" name="credit" value="yes" form="paymentForm" <?php echo $credit_selected ? 'checked' : ''; ?>>
                <div id="credit-info" style="display: <?php echo $credit_selected ? 'block' : 'none'; ?>;">
                    <h3>Banque de Prêt</h3>
                    <p><strong>Nom:</strong> Banque Immo</p>
                    <p><strong>Email:</strong> contact@banqueimmo.com</p>
                    <p><strong>Téléphone:</strong> 02 98 76 54 32</p>
                    <p><strong>Personne à contacter:</strong> Martin Wyks</p>
                    <p><strong>Info:</strong> Taux d'intérêt de 1%, remboursable en 48 mois.</p>
                    <p><strong>Remboursement / Mensualité :</strong> <span id="mensualite">€<?php echo number_format($mensualite, 0, ',', ' '); ?></span> sur 48 mois</p>
                </div>
            </div>
        </div>
        <div class="right-column">
            <h1 style="color: white;">Page de Paiement</h1>
            <form method="POST" id="paymentForm">
                <h2>Informations de Facturation</h2>
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                
                <label for="address1">Adresse :</label>
                <input type="text" id="address1" name="address1" value="<?php echo isset($_POST['address1']) ? $_POST['address1'] : ''; ?>" required>
                
                <label for="city">Ville :</label>
                <input type="text" id="city" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>" required>
                
                <label for="postal_code">Code Postal :</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo isset($_POST['postal_code']) ? $_POST['postal_code'] : ''; ?>" required pattern="\d*">
                
                <label for="country">Pays :</label>
                <input type="text" id="country" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>" required>
                
                <label for="phone">Numéro de Téléphone :</label>
                <input type="text" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required pattern="\d*">
                
                <h2>Informations de Paiement</h2>
                <label for="card_number">Numéro de Carte :</label>
                <input type="text" id="card_number" name="card_number" required pattern="\d*">
                
                <label for="card_name">Nom sur la Carte :</label>
                <input type="text" id="card_name" name="card_name" required>
                
                <label for="expiry_date">Date d'Expiration :</label>
                <div>
                    <select id="expiry_month" name="expiry_month" required>
                        <option value="" disabled selected>Mois</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                        <?php endfor; ?>
                    </select>
                    <select id="expiry_year" name="expiry_year" required>
                        <option value="" disabled selected>Année</option>
                        <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <label for="security_code">Code de Sécurité :</label>
                <input type="text" id="security_code" name="security_code" required pattern="\d*">
                
                <input type="submit" value="Soumettre le Paiement" onclick="simulateLoading(); return false;">
            </form>
            <div id="loading" style="display: none;">Chargement...</div>
        </div>
    </main>
    <?php if ($is_success === false): ?>
        <div id="errorPopup" class="popup">
            <div class="popup-content">
                <p><?php echo $message; ?></p>
                <button onclick="closePopup();" class="btn"><?php echo empty($missing_fields) ? 'Réessayer' : 'Remplir mes informations'; ?></button>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
