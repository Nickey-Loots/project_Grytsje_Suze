<?php
include 'auth.php';
$host = 'localhost';
$db = 'grytsje suze';
$user = 'bit_academy';
$pass = 'bit_academy';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$id = $_GET['id'] ?? die("Geen ID");
$stmt = $pdo->prepare("SELECT * FROM tassen WHERE id = ?");
$stmt->execute([$id]);
$tas = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fotoPath = $tas['afbeelding'];
    $modelPath = $tas['model_3d'];

    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === 0) {
        $n = time() . '_' . $_FILES['afbeelding']['name'];
        if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], "../uploads/" . $n)) {
            if (file_exists("../" . $tas['afbeelding']))
                unlink("../" . $tas['afbeelding']);
            $fotoPath = "uploads/" . $n;
        }
    }

    if (isset($_FILES['model_3d']) && $_FILES['model_3d']['error'] === 0) {
        $m = time() . '_' . $_FILES['model_3d']['name'];
        if (move_uploaded_file($_FILES['model_3d']['tmp_name'], "../uploads/" . $m)) {
            if ($tas['model_3d'] && file_exists("../" . $tas['model_3d']))
                unlink("../" . $tas['model_3d']);
            $modelPath = "uploads/" . $m;
        }
    }

    $sql = "UPDATE tassen SET naam=?, beschrijving=?, afbeelding=?, kleurcode=?, model_3d=? WHERE id=?";
    $pdo->prepare($sql)->execute([$_POST['naam'], $_POST['beschrijving'], $fotoPath, $_POST['kleurcode'], $modelPath, $id]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tas Bewerken</title>
    <link rel="stylesheet" href="../public/css/output.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
    <style>
        model-viewer { width: 100%; height: 300px; background-color: #f9fafb; border-radius: 1rem; }
        .drag-area { border: 2px dashed #d8b4fe; transition: all 0.2s ease; }
        .drag-area:hover { border-color: #a855f7; background-color: #f5f3ff; }
    </style>
</head>
<body class="bg-gray-100 font-sans pb-20">
    <nav class="bg-gray-900 h-16 flex items-center px-6 mb-10 shadow-lg text-white font-bold uppercase tracking-widest">
        <span>Admin<span class="text-blue-500">Panel</span></span>
    </nav>

    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4 text-center md:text-left">Tas Aanpassen</h2>
            
            <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Naam</label>
                        <input type="text" name="naam" value="<?= htmlspecialchars($tas['naam']) ?>"
                            class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Beschrijving</label>
                        <textarea name="beschrijving" rows="4" class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none transition"><?= htmlspecialchars($tas['beschrijving']) ?></textarea>
                        </div>

                    <div class="bg-purple-50 p-6 rounded-2xl drag-area cursor-pointer" onclick="document.getElementById('model-input').click();">
                        <label class="block text-xs font-bold text-purple-400 uppercase mb-3 text-center">3D Model (Klik om te wijzigen)</label>
                        <model-viewer id="model-preview" src="../<?= $tas['model_3d'] ?>" auto-rotate camera-controls
        shadow-intensity="1"></model-viewer>
    <input type="file" name="model_3d" id="model-input" accept=".glb" class="hidden">
</div>

                    <div class="bg-blue-50 p-6 rounded-2xl border-2 border-blue-100">
                        <label class="block text-xs font-bold text-blue-400 uppercase mb-3">Kleurcode</label>
                        <div class="flex items-center gap-4">
                            <input type="color" name="kleurcode" id="kleurcode" value="<?= $tas['kleurcode'] ?>"
                                class="h-12 w-12 cursor-pointer bg-transparent">
                            <button type="button" id="pipet-btn"
                                class="flex-1 bg-white border-2 border-blue-200 py-3 rounded-xl font-bold text-blue-600">Pipet / Tik op
                                foto</button>
                            </div>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-3 self-start">Foto (Klik om te wijzigen)</label>
                    <img id="preview-img" src="../<?= $tas['afbeelding'] ?>"
                        class="w-full aspect-square object-cover rounded-3xl border-8 border-white shadow-2xl cursor-pointer"
                        onclick="document.getElementById('file-input').click();">
                    <input type="file" name="afbeelding" id="file-input" accept="image/*" class="hidden">
                </div>

                <div class="md:col-span-2 flex justify-between items-center pt-8 border-t mt-4">
                    <a href="index.php" class="text-gray-400 font-bold uppercase text-sm">Annuleren</a>
                    <button type="submit" class="bg-blue-600 text-white font-black py-4 px-12 rounded-2xl shadow-lg uppercase tracking-widest">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('model-input').addEventListener('change', e => {
            if(e.target.files[0]) document.getElementById('model-preview').src = URL.createObjectURL(e.target.files[0]);
        });
        document.getElementById('file-input').addEventListener('change', e => {
            const r = new FileReader(); r.onload = ev => document.getElementById('preview-img').src = ev.target.result;
            r.readAsDataURL(e.target.files[0]);
        });
        // Pipet logica (gelijk aan toevoegen)
        const pipetBtn = document.getElementById('pipet-btn');
        if ('EyeDropper' in window) {
            const ed = new EyeDropper();
            pipetBtn.addEventListener('click', () => {
                ed.open().then(res => { document.getElementById('kleurcode').value = res.sRGBHex; });
            });
        }
    </script>
</body>
</html>