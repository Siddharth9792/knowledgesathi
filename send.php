<?php
session_start();

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify captcha first
if (!isset($_POST['6_letters_code']) || empty($_POST['6_letters_code']) || $_POST['6_letters_code'] != $_SESSION['6_letters_code']) {
    die("Invalid captcha code. Please go back and try again.");
}

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to sanitize input
function sanitizeInput($data) {
    if (empty($data)) return '';
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

// Check required fields
$requiredFields = ['name', 'email', 'dob', 'gender', 'grade', 'transaction_id'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        die("Required field '$field' is missing.");
    }
}

// Collect and sanitize personal information
$name = sanitizeInput($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}
$dob = sanitizeInput($_POST['dob']);
$gender = sanitizeInput($_POST['gender']);
$grade = sanitizeInput($_POST['grade']);

// Collect Part II responses with default values
$responses = [
    'encouraged' => sanitizeInput($_POST['encouraged'] ?? 'Not answered'),
    'willingToLearn' => sanitizeInput($_POST['willingToLearn'] ?? 'Not answered'),
    'girlsCourses' => sanitizeInput($_POST['girlsCourses'] ?? 'Not answered'),
    'teachersTreatEqually' => sanitizeInput($_POST['teachersTreatEqually'] ?? 'Not answered'),
    'femaleStudents' => sanitizeInput($_POST['femaleStudents'] ?? 'Not answered'),
    'maleStudents' => sanitizeInput($_POST['maleStudents'] ?? 'Not answered'),
    'untraditionalCareers' => sanitizeInput($_POST['untraditionalCareers'] ?? 'Not answered'),
    'supportGroups' => sanitizeInput($_POST['supportGroups'] ?? 'Not answered'),
    'sameCareerGoal' => sanitizeInput($_POST['sameCareerGoal'] ?? 'Not answered'),
    'knowCareer' => sanitizeInput($_POST['knowCareer'] ?? 'Not answered'),
    'confidentCareerGoals' => sanitizeInput($_POST['confidentCareerGoals'] ?? 'Not answered'),
    'parentsSupport' => sanitizeInput($_POST['parentsSupport'] ?? 'Not answered'),
    'maleFriendsSupport' => sanitizeInput($_POST['maleFriendsSupport'] ?? 'Not answered'),
    'femaleFriendsSupport' => sanitizeInput($_POST['femaleFriendsSupport'] ?? 'Not answered'),
    'selfSufficient' => sanitizeInput($_POST['selfSufficient'] ?? 'Not answered'),
    'enjoyExploring' => sanitizeInput($_POST['enjoyExploring'] ?? 'Not answered'),
    'beAnything' => sanitizeInput($_POST['beAnything'] ?? 'Not answered'),
    'makeDecisions' => sanitizeInput($_POST['makeDecisions'] ?? 'Not answered'),
    'careerGoalsBasedOnAbilities' => sanitizeInput($_POST['careerGoalsBasedOnAbilities'] ?? 'Not answered')
];

// Collect Part III career choices
$careerChoices = [];
$choiceLabels = [
    'checkvalue1' => 'I enjoy analyzing data using statistics',
    'checkvalue2' => 'I would like to find solutions to economic problems',
    'checkvalue3' => 'I am interested in art',
    'checkvalue4' => 'I enjoy entertaining the audience',
    'checkvalue5' => 'I am against injustice and inequality',
    'checkvalue6' => 'I am an extrovert person',
    'checkvalue7' => 'I like repairing things in my house',
    'checkvalue8' => 'I am interested in industrial design',
    'checkvalue9' => 'I always check my medical reports in details',
    'checkvalue10' => 'I enjoy helping people',
    'checkvalue11' => 'I am interested in programming',
    'checkvalue12' => 'I prefer working on my own'
];

foreach ($choiceLabels as $field => $label) {
    if (isset($_POST[$field]) && $_POST[$field] == 'Yes') {
        $careerChoices[] = $label;
    }
}

// Payment information
$transactionId = sanitizeInput($_POST['transaction_id']);

// Handle file upload
$paymentProof = '';
if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    $fileType = $_FILES['payment_proof']['type'];
    $fileSize = $_FILES['payment_proof']['size'];
    
    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.");
    }
    
    if ($fileSize > $maxSize) {
        die("File is too large. Maximum size is 5MB.");
    }
    
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        die("Failed to create upload directory.");
    }
    
    $fileName = uniqid('payment_', true) . '.' . pathinfo($_FILES['payment_proof']['name'], PATHINFO_EXTENSION);
    $targetPath = $uploadDir . $fileName;
    
    if (!move_uploaded_file($_FILES['payment_proof']['tmp_name'], $targetPath)) {
        die("Failed to upload file.");
    }
    
    $paymentProof = $targetPath;
}

// Create the email body
$emailBody = "<h1>Career Counseling Form Submission</h1>";

// Part I: Personal Information
$emailBody .= "<h2>Part I: Personal Information</h2>";
$emailBody .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
$emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Name:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$name</td></tr>";
$emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Email:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$email</td></tr>";
$emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Date of Birth:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$dob</td></tr>";
$emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Gender:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$gender</td></tr>";
$emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Grade:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$grade</td></tr>";
$emailBody .= "</table>";

// Part II: Career Support Questionnaire
$emailBody .= "<h2 style='margin-top: 20px;'>Part II: Career Support Questionnaire</h2>";
$emailBody .= "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";

$questionLabels = [
    'encouraged' => '1. Encouraged by school authorities for career courses',
    'willingToLearn' => '2. Willing to learn about future career opportunities',
    'girlsCourses' => '3. Some courses are especially for girls',
    'teachersTreatEqually' => '4. Teachers treat students equally',
    'femaleStudents' => '5. Teachers pay more attention to female students',
    'maleStudents' => '6. Teachers pay more attention to male students',
    'untraditionalCareers' => '7. Teachers encourage untraditional career choices',
    'supportGroups' => '8. Support groups for untraditional career choices',
    'sameCareerGoal' => '9. Same career goal as friends',
    'knowCareer' => '10. Know future career plans',
    'confidentCareerGoals' => '11. Confident about reaching career goals',
    'parentsSupport' => '12. Parents support career choice',
    'maleFriendsSupport' => '13. Male friends support career choice',
    'femaleFriendsSupport' => '14. Female friends support career choice',
    'selfSufficient' => '15. Important to be economically self-sufficient',
    'enjoyExploring' => '16. Enjoy exploring different things',
    'beAnything' => '17. Can be whatever I want to be',
    'makeDecisions' => '18. Can make my own decisions',
    'careerGoalsBasedOnAbilities' => '19. Set career goals based on abilities'
];

foreach ($questionLabels as $key => $label) {
    $emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>$label:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>{$responses[$key]}</td></tr>";
}
$emailBody .= "</table>";

// Part III: Career Choices
$emailBody .= "<h2 style='margin-top: 20px;'>Part III: Career Choices</h2>";
if (!empty($careerChoices)) {
    $emailBody .= "<ul style='padding-left: 20px;'>";
    foreach ($careerChoices as $choice) {
        $emailBody .= "<li style='margin-bottom: 5px;'>$choice</li>";
    }
    $emailBody .= "</ul>";
} else {
    $emailBody .= "<p>No career choices selected</p>";
}

// Part IV: Payment Information
$emailBody .= "<h2 style='margin-top: 20px;'>Part IV: Payment Information</h2>";
$emailBody .= "<p><strong>Transaction/Reference Number:</strong> $transactionId</p>";

try {
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'knowledgesathi1@gmail.com';
    $mail->Password = 'fjqp ahei xdpz ibzx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPDebug = 0; // Set to 2 for detailed debugging
    
    // Recipients
    $mail->setFrom('knowledgesathi1@gmail.com', 'Career Counseling Form');
    $mail->addAddress('knowledgesathi1@gmail.com', 'Knowledge Sathi');
    
    // Attachments
    if ($paymentProof) {
        $mail->addAttachment($paymentProof);
    }
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Career Counseling Form Submission - ' . $name;
    $mail->Body = $emailBody;
    
    // Create plain-text version of the email
    $plainText = "Career Counseling Form Submission\n\n";
    $plainText .= "Part I: Personal Information\n";
    $plainText .= "Name: $name\n";
    $plainText .= "Email: $email\n";
    $plainText .= "Date of Birth: $dob\n";
    $plainText .= "Gender: $gender\n";
    $plainText .= "Grade: $grade\n\n";
    
    $plainText .= "Part II: Career Support Questionnaire\n";
    foreach ($questionLabels as $key => $label) {
        $plainText .= "$label: {$responses[$key]}\n";
    }
    $plainText .= "\n";
    
    $plainText .= "Part III: Career Choices\n";
    if (!empty($careerChoices)) {
        foreach ($careerChoices as $choice) {
            $plainText .= "- $choice\n";
        }
    } else {
        $plainText .= "No career choices selected\n";
    }
    $plainText .= "\n";
    
    $plainText .= "Part IV: Payment Information\n";
    $plainText .= "Transaction/Reference Number: $transactionId\n";
    
    $mail->AltBody = $plainText;
    
    // Send email
    if (!$mail->send()) {
        throw new Exception('Mailer Error: ' . $mail->ErrorInfo);
    }
    
    // Clean up
    if ($paymentProof && file_exists($paymentProof)) {
        unlink($paymentProof);
    }
    
    // Redirect to WhatsApp
    $whatsappMessage = rawurlencode("Hello Knowledge Sathi, I have submitted the career counseling form. My details:\nName: $name\nTransaction ID: $transactionId");
    header("Location: https://wa.me/919792097594?text=$whatsappMessage");
    exit();
    
} catch (Exception $e) {
    // Clean up file if exists
    if (!empty($paymentProof) && file_exists($paymentProof)) {
        unlink($paymentProof);
    }
    
    // Log the error
    error_log("Form Submission Error: " . $e->getMessage());
    
    // User-friendly error message
    die("Sorry, there was an error submitting your form. Please try again later or contact support.");
}
?>