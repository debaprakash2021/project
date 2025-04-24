<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Labour Information Portal</title>
    <style>
        .hero-slide {
            animation: fade 12s infinite;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-slide:nth-child(1) { animation-delay: 0s; }
        .hero-slide:nth-child(2) { animation-delay: 3s; }
        .hero-slide:nth-child(3) { animation-delay: 6s; }
        .hero-slide:nth-child(4) { animation-delay: 9s; }
        @keyframes fade {
            0% { opacity: 0; }
            10% { opacity: 1; }
            25% { opacity: 1; }
            35% { opacity: 0; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="flex justify-between w-full md:w-auto items-center">
                <a href="#" class="text-2xl font-bold hover:text-yellow-300">Labour Portal</a>
                <button class="md:hidden text-2xl" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <ul class="hidden md:flex space-x-6 mt-4 md:mt-0" id="menu-items">
                <li><a href="HomePage.html" class="hover:underline hover:text-yellow-300">🏠Home</a></li>
                <li><a href="policies.html" class="hover:underline hover:text-yellow-300">⚖️Policies</a></li>
                <li><a href="showsNews.html" class="hover:underline hover:text-yellow-300">📰News</a></li>
                <li><a href="helpDashboard.html" class="hover:underline hover:text-yellow-300">☎️Help Dashboard</a></li>
                <li><a href="filecomplain.html" class="hover:underline hover:text-yellow-300">📝File a Complaint</a></li>
            </ul>
<!-- In your navbar section, replace the current auth-buttons div with this: -->
<div class="hidden md:block mt-4 md:mt-0" id="auth-buttons">
    <div class="flex items-center space-x-4">
        <div class="relative">
            <button id="adminDropdownBtn" class="flex items-center space-x-2 bg-blue-700 px-4 py-2 rounded-full hover:bg-blue-800 transition">
                <i class="fas fa-user-circle text-2xl"></i>
                <div class="text-left">
                    <p class="text-sm font-semibold">Normal User</p>
                    <p class="text-xs">
                        <?php
                        if(isset($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            $query = mysqli_query($conn, "SELECT normal_user.* FROM normal_user WHERE normal_user.Email='$email'");
                            while($row = mysqli_fetch_array($query)) {
                                echo $row['Full Name'];
                            }
                        }
                        ?>
                    </p>
                </div>
            </button>
            
            <!-- Dropdown content -->
            <div id="adminDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                <div class="p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <i class="fas fa-user-circle text-3xl text-blue-600"></i>
                        <div>
                            <p class="font-semibold text-gray-800">
                                <?php
                                if(isset($_SESSION['email'])) {
                                    $email = $_SESSION['email'];
                                    $query = mysqli_query($conn, "SELECT normal_user.* FROM normal_user WHERE normal_user.Email='$email'");
                                    while($row = mysqli_fetch_array($query)) {
                                        echo $row['Full Name'];
                                    }
                                }
                                ?>
                            </p>
                            <p class="text-sm text-gray-600 truncate">
                                <?php
                                if(isset($_SESSION['email'])) {
                                    $email = $_SESSION['email'];
                                    $query = mysqli_query($conn, "SELECT normal_user.* FROM normal_user WHERE normal_user.Email='$email'");
                                    while($row = mysqli_fetch_array($query)) {
                                        echo $row['Email'];
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <a href="logout.php" class="block w-full text-center bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script at the bottom of your page, before </body> -->
        </div>
    </nav>

    <!-- Hero Section with Slider -->
    <section class="relative text-center py-20 text-white min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-blue-900/70 z-0"></div>
        <img src="https://images.pexels.com/photos/20445207/pexels-photo-20445207/free-photo-of-farmers-in-india.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="hero-slide" alt="Labour Image 1">
        <img src="https://images.pexels.com/photos/27722065/pexels-photo-27722065/free-photo-of-farmers-in-india.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="hero-slide" alt="Labour Image 2">
        <img src="https://images.pexels.com/photos/2219035/pexels-photo-2219035.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="hero-slide" alt="Labour Image 3">
        <img src="https://images.pexels.com/photos/30571037/pexels-photo-30571037/free-photo-of-brick-workers-carrying-heavy-load-outdoors.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="hero-slide" alt="Labour Image 4">
        <div class="container mx-auto px-4 z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Labour Laws Compliance while reducing intrusion</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto">Find all the government schemes, worker rights, employer information, and more.</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="min-h-screen bg-white py-20 px-4">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-600">Our Services</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Worker Rights</h3>
                    <p class="text-gray-700">Learn about your rights as a worker and how to protect them in various employment situations.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Government Schemes</h3>
                    <p class="text-gray-700">Discover various government schemes and benefits available for workers across different sectors.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Employer Guidelines</h3>
                    <p class="text-gray-700">Understand your responsibilities as an employer and comply with labour laws and regulations.</p>
                </div>
            </div>
            
            <!-- More content to enable scrolling -->
            <div class="mt-20">
                <h3 class="text-2xl font-semibold mb-6 text-blue-600">Important Links</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-5 rounded-lg">
                        <h4 class="font-bold mb-3 text-blue-700">Central Ministries and Departments</h4>
                        <a href="https://labour.gov.in/" class="text-blue-600 hover:underline inline-block mt-2">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="bg-blue-50 p-5 rounded-lg">
                        <h4 class="font-bold mb-3 text-blue-700">State Government</h4>
                        <a href="https://labour.gov.in/state-government-labour-departments" class="text-blue-600 hover:underline inline-block mt-2">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="bg-blue-50 p-5 rounded-lg">
                        <h4 class="font-bold mb-3 text-blue-700">Other Organisations</h4>
                        <a href="https://labour.gov.in/state-government-labour-departments" class="text-blue-600 hover:underline inline-block mt-2">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Additional content to make page scrollable -->
            <div class="mt-20">
                <h3 class="text-2xl font-semibold mb-6 text-blue-600">Latest Updates</h3>
                <div class="space-y-6">
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h4 class="font-bold">New Labour Policy Announcement</h4>
                        <p class="text-gray-600">The government has announced new policies to improve working conditions...</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h4 class="font-bold">Upcoming Training Programs</h4>
                        <p class="text-gray-600">Skill development programs for workers in various sectors will be conducted...</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h4 class="font-bold">Holiday Calendar Update</h4>
                        <p class="text-gray-600">Revised holiday calendar for industrial workers has been published...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-6">
                <div>
                    <h3 class="text-lg font-bold mb-4">LabourSahayata</h3>
                    <p class="text-gray-400">Comprehensive portal for labour laws, employment guidelines and grievance redressal system.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Helplines</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                            <span class="text-gray-400">1800-123-456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                            <span class="text-gray-400">help@laboursahayata.gov.in</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                            <span class="text-gray-400">New Delhi, India</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white text-xl">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-medium mb-2">Download Mobile App</h4>
                        <div class="flex space-x-2">
                            <button class="bg-black text-white px-3 py-1 rounded text-sm flex items-center">
                                <i class="fab fa-apple mr-1"></i> App Store
                            </button>
                            <button class="bg-black text-white px-3 py-1 rounded text-sm flex items-center">
                                <i class="fab fa-google-play mr-1"></i> Play Store
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                <p>© 2024 LabourSahayata Portal. All rights reserved.</p>
                <p class="mt-1">Designed and developed by National Informatics Centre</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menuItems = document.getElementById('menu-items');
            const authButtons = document.getElementById('auth-buttons');
            
            menuItems.classList.toggle('hidden');
            menuItems.classList.toggle('flex');
            menuItems.classList.toggle('flex-col');
            menuItems.classList.toggle('space-y-4');
            menuItems.classList.toggle('space-x-6');
            menuItems.classList.toggle('w-full');
            menuItems.classList.toggle('text-center');
            
            authButtons.classList.toggle('hidden');
            authButtons.classList.toggle('flex');
            authButtons.classList.toggle('flex-col');
            authButtons.classList.toggle('space-y-4');
            authButtons.classList.toggle('mt-4');
            authButtons.classList.toggle('w-full');
            authButtons.classList.toggle('items-center');
        });
    // Admin dropdown toggle
    document.getElementById('adminDropdownBtn').addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event bubbling
        document.getElementById('adminDropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('adminDropdown');
        const button = document.getElementById('adminDropdownBtn');
        
        if (!dropdown.contains(e.target) && !button.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</body>
</html>