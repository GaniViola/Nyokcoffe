<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title><?= $data['judul']; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 w-full min-h-screen">
  <div class="flex items-center justify-center w-full min-h-screen">
    <div class="bg-white shadow-md rounded-lg flex w-full h-full">
      <!-- Bagian Form Registrasi -->
      <div class="w-full sm:w-1/2 p-8 flex flex-col justify-center">
        <div class="flex justify-between items-center mb-6">
          <div class="text-3xl font-bold text-gray-800">Kopi Pos</div>
          <a class="text-blue-600" href="<?= BASEURL; ?>">Sign in</a>
        </div>
        <h2 class="text-3xl font-semibold mb-4 text-gray-800">Create an account</h2>
        <p class="text-gray-600 mb-6">Sign up to create an account and explore many things.</p>
        
        <!-- Formulir Registrasi -->
        <form action="<?= BASEURL; ?>/register/createAkun" method="post">
          
          <!-- Pesan Kesalahan -->
          <?php if (isset($data['pesan']) && $data['pesan'] != ''): ?>
            <div class="mb-4 text-red-600">
              <?= $data['pesan']; ?>
            </div>
          <?php endif; ?>

          <div class="mb-4">
            <label class="block text-gray-700" for="username">Username</label>
            <input id="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="username" placeholder="Username" type="text" required value="<?= isset($data['username']) ? $data['username'] : ''; ?>"/>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700" for="email">Email</label>
            <input id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="email" placeholder="name@example.com" type="email" required value="<?= isset($data['email']) ? $data['email'] : ''; ?>"/>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700" for="password">Password</label>
            <input id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="password" placeholder="********" type="password" required/>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700" for="confirm-password">Confirm Password</label>
            <input id="confirm-password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="kpwd" placeholder="********" type="password" required/>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700" for="no_tlp">Phone Number</label>
            <input id="no_tlp" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="no_tlp" placeholder="Phone number" type="tel" required value="<?= isset($data['no_tlp']) ? $data['no_tlp'] : ''; ?>"/>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700" for="alamat">Address</label>
            <input id="alamat" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="alamat" placeholder="Your address" type="text" required value="<?= isset($data['alamat']) ? $data['alamat'] : ''; ?>"/>
          </div>

          <div class="mb-4 flex items-center">
            <input class="mr-2" id="terms" type="checkbox" name="accept_terms" required/>
            <label class="text-gray-600" for="terms">
              Yes, I understand and agree to Kopi Pos
              <a class="text-blue-600" href="#">Terms of Service</a>
            </label>
          </div>
          <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">Sign up</button>
          <div class="mt-4">
            <button class="w-full bg-white border border-gray-300 text-gray-700 py-2 rounded-lg flex items-center justify-center hover:bg-gray-100 transition duration-200">
              <i class="fab fa-google mr-2"></i>Sign up with Google
            </button>
          </div>
         
        </form>
      </div>

      <!-- Bagian Informasi -->
      <div class="w-full sm:w-1/2 bg-blue-600 text-white p-8 flex flex-col justify-center items-center">
        <img alt="KopiPos Banner" class="mb-6 max-w-2xl w-full" src="<?= BASEURL; ?>/img/register.png"/>
        <h2 class="text-2xl font-semibold mb-2">Sistem Informasi Kasir KopiPos</h2>
        <p class="text-center">Untukmu yang layak mendapatkan pengalaman istimewa. Kreativitas, keramahan, dan semangatmu membuat kafe kami lebih hidup setiap hari.</p>
      </div>
    </div>
  </div>
</body>
</html>
