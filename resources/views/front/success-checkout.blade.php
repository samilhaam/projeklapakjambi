<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Success Page</title>
  <link href="./output.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
</head>

<body class="bg-belibang-black font-poppins text-white">
  <!-- Navbar -->
  <nav class="w-full bg-[#00000010] backdrop-blur-lg z-10">
    <div class="max-w-[1130px] mx-auto flex items-center justify-between h-[74px]">
      <div class="flex items-center gap-[26px]">
        <a href="index.html" class="w-[154px] shrink-0 flex items-center">
          <img src="/images/logos/logo.svg" alt="logo" />
        </a>
        <ul class="flex gap-6 items-center">
          <li><a href="index.html" class="text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">Home</a></li>
          <li class="relative">
            <button id="menu-button" class="flex items-center gap-1 text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">
              <span>Categories</span>
              <img src="/images/icons/arrow-down.svg" alt="arrow icon" />
            </button>
            <div class="dropdown-menu hidden absolute top-[52px] grid grid-cols-2 p-4 gap-[10px] w-[526px] rounded-[20px] bg-[#1E1E1E] border border-[#414141] z-10">
              <!-- Dropdown Items -->
              <!-- Item: All Products -->
              <div class="col-span-2 flex justify-between items-center rounded-2xl p-4 border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                <div class="flex items-center gap-3">
                  <a href="" class="w-[58px] h-[58px] flex items-center">
                    <img src="/images/icons/cart.svg" alt="cart" />
                  </a>
                  <a href="" class="flex flex-col">
                    <p class="font-bold text-sm text-white">All Products</p>
                    <p class="text-xs text-lapakjmb-grey">Everything in One Place</p>
                  </a>
                </div>
                <img src="/images/icons/crown.svg" alt="crown" class="w-6 h-6" />
              </div>

              <!-- Other categories -->
              <div class="flex items-center gap-3 rounded-2xl p-4 border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                <a href="" class="w-[58px] h-[58px] flex items-center">
                  <img src="/images/icons/laptop.svg" alt="laptop" />
                </a>
                <a href="" class="flex flex-col">
                  <p class="font-bold text-sm text-white">Templates</p>
                  <p class="text-xs text-lapakjmb-grey">Designs Made Easy</p>
                </a>
              </div>
              <div class="flex items-center gap-3 rounded-2xl p-4 border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                <a href="" class="w-[58px] h-[58px] flex items-center">
                  <img src="/images/icons/hat.svg" alt="hat" />
                </a>
                <a href="" class="flex flex-col">
                  <p class="font-bold text-sm text-white">Courses</p>
                  <p class="text-xs text-lapakjmb-grey">Expand Your Skills</p>
                </a>
              </div>
              <div class="flex items-center gap-3 rounded-2xl p-4 border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                <a href="" class="w-[58px] h-[58px] flex items-center">
                  <img src="/images/icons/book.svg" alt="book" />
                </a>
                <a href="" class="flex flex-col">
                  <p class="font-bold text-sm text-white">Ebooks</p>
                  <p class="text-xs text-lapakjmb-grey">Read and Learn</p>
                </a>
              </div>
              <div class="flex items-center gap-3 rounded-2xl p-4 border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                <a href="" class="w-[58px] h-[58px] flex items-center">
                  <img src="/images/icons/pen.svg" alt="pen" />
                </a>
                <a href="" class="flex flex-col">
                  <p class="font-bold text-sm text-white">Fonts</p>
                  <p class="text-xs text-lapakjmb-grey">Typography Selection</p>
                </a>
              </div>
            </div>
          </li>
          <li><a href="" class="text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">Stories</a></li>
          <li><a href="" class="text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">Benefits</a></li>
          <li><a href="" class="text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">About</a></li>
        </ul>
      </div>
      <div class="flex gap-6 items-center">
        <a href="" class="text-lapakjmb-grey hover:text-belibang-light-grey transition-all duration-300">Log in</a>
        <a href="" class="p-2 px-4 rounded-[12px] text-lapakjmb-grey border border-belibang-dark-grey hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">Sign up</a>
      </div>
    </div>
  </nav>

  <!-- Success Section -->
  <section id="Success" class="max-w-[1130px] mx-auto">
    <div class="w-full flex items-center justify-center min-h-[calc(100vh-74px)]">
      <div class="flex flex-col items-center gap-[60px]">
        <div class="flex flex-col items-center">
          <div class="relative w-[174px] h-[174px]">
            <img src="/images/icons/check-3d.svg" alt="Success Checkmark" />
            <div class="absolute w-[644px] -translate-x-1/2 left-1/2 bottom-[35px] z-0">
              <img src="/images/backgrounds/glitter.svg" alt="Glitter Background" />
            </div>
          </div>
          <div class="text-center space-y-1">
            <p class="font-semibold text-[36px] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
              Success Checkout
            </p>
            <p class="text-xs text-lapakjmb-grey">Thank you for supporting our great creators</p>
          </div>
        </div>
        <a href="index.html" class="w-[306px] h-12 flex items-center justify-center rounded-full bg-[#2D68F8] p-2 px-4 font-semibold hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">
          Check My Transactions
        </a>
      </div>
    </div>
  </section>

  <!-- Dropdown Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const menuButton = document.getElementById('menu-button');
      const dropdownMenu = document.querySelector('.dropdown-menu');

      menuButton.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
    });
  </script>
</body>

</html>
