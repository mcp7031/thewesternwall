
<footer class="bg-blue-400">
    <!-- Flex Container -->
    <div
        class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0"
    >
        <!-- Logo and social links container -->
        <div
            class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start"
        >
            <div class="mx-auto my-6 text-center text-white md:hidden">
                Copyright &copy; 2024, All Rights Reserved
            </div>
            <!-- Logo -->
            <div><img src="{{ asset('/images/RTVFree.png') }}" alt="FreedomRTV Logo" width="165" height="16"></div>
            <!-- Social links Container -->
            <div class="flex justify-between space-x-4">
                <!-- Link 1 -->
                <a target="_blank" href="https://facebook.com/RockTheVoteNewZealand"> <img src="{{ asset('/images/icon-facebook.svg') }}" alt="facebook icon" class="h-8" />
                </a>
                <!-- Link 2 -->
                <a target="_blank" href="#"> <img src="{{ asset('/images/icon-youtube.svg') }}" alt="youtube icon" class="h-8" />
                </a>
                <!-- Link 3 -->
                <a target="_blank" href="#"> <img src="{{ asset('/images/icon-twitter.svg') }}" alt="twitter icon" class="h-8" />
                </a>
                <!-- Link 4 -->
                <a target="_blank" href="#"> <img src="{{ asset('/images/icon-pinterest.svg') }}" alt="pinterest icon" class="h-8" />
                </a>
                <a target="_blank" href="https://meetup.com/rockthevotenz"> <img src="{{ asset('/images/Meetup.webp') }}" alt="pinterest icon" class="h-8" />
                </a>
                <!-- Link 5 -->
                <a target="_blank" href="https://www.instagram.com/rockthevotenzparty"> <img src="{{ asset('/images/icon-instagram.svg') }}" alt="instagram icon" class="h-8" />
                </a>
                <!-- Link 6 -->
                <a target="_blank" href="https://rumble.com/c/RockTheVoteNZ"> <img src="{{ asset('/images/rumble-icon.jpg') }}" alt="rumble icon" class="h-8" />
                </a>
            </div>
            © 2024 TheWesternWall.nz
        </div>
        <!-- List Container -->
        <div class="flex justify-around space-x-32">
            <div class="flex flex-col space-y-3 text-white">
                <a href="/" class="hover:text-brightRed"
                >Home</a
                >
                <a href="/inventory" class="hover:text-brightRed"
                >Products</a
                >
                <a href="/about" class="hover:text-brightRed"
                >About</a
                >
            </div>
            <div class="flex flex-col space-y-3 text-white">
                <a href="/community" class="hover:text-brightRed"
                >Community</a
                >
                <a href="/aoc" class="hover:text-brightRed"
                >Categories</a
                >
                <a href="#" class="hover:text-brightRed"
                >Privacy Policy</a
                >
            </div>
        </div>
    </div>
    </div>
</footer>
</html>
