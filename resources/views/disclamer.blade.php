<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disclaimer - GyaanGhar</title>
    <meta name="description" content="Read the GyaanGhar disclaimer regarding the use of our platform and the accuracy of educational content provided by users.">

    <link rel="canonical" href="{{ url('/disclaimer') }}" />
    <meta property="og:title" content="Disclaimer - GyaanGhar" />
    <meta property="og:description" content="Read the GyaanGhar disclaimer regarding the use of our platform and the accuracy of educational content provided by users." />
    <meta property="og:url" content="{{ url('/disclaimer') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg" /> {{-- Using a relevant general image --}}
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .content-section p, .content-section li {
            line-height: 1.75; /* Increased line height for readability */
            margin-bottom: 1rem; /* Consistent paragraph spacing */
        }
        .content-section h2 {
            font-size: 1.5rem; /* 24px */
            font-weight: 600; /* semibold */
            color: #1f2937; /* gray-800 */
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb; /* gray-200 */
            padding-bottom: 0.5rem;
        }
        .content-section strong {
            color: #111827; /* gray-900 */
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/disclaimer'); // Specific URL for the Disclaimer page

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
            'description' => 'GyaanGhar is the ultimate platform for personalized learning and seamless access to educational resources.',
        ];

        // For legal pages, WebPage is often sufficient, but you can specify further.
        $disclaimerPageSchema = [
            '@type' => 'WebPage',
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => 'Disclaimer - GyaanGhar',
            'description' => "Read the GyaanGhar disclaimer regarding the use of our platform and the accuracy of educational content provided by users.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'mainEntity' => [ // The main content of this page is the disclaimer text itself
                '@type' => 'WebContent', // Or CreativeWork if more appropriate
                'headline' => 'GyaanGhar Platform Disclaimer',
                 // 'text' => "Full text of the disclaimer could go here if needed for schema, or just rely on page content."
                 // You can include a significant portion of the disclaimer text here if you want to be very specific for schema.
                 // For brevity, I'll omit the full text in this schema block.
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Disclaimer']
                ]
            ]
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $disclaimerPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-9 sm:h-10 mr-2">
                <span class="text-xl sm:text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
            </a>
            <nav class="flex items-center space-x-2 sm:space-x-4">
                 <a href="javascript:history.back()" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                    <ph-arrow-left size="16" weight="bold" class="sm:mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                    <span class="hidden sm:inline">Back</span>
                </a>
                <a href="/" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                     <ph-house size="16" weight="bold" class="sm:mr-1"></ph-house>
                    <span class="hidden sm:inline">Home</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="py-12 sm:py-16">
        <!-- Hero Section for Disclaimer -->
        <div class="bg-gradient-to-br from-red-50 via-yellow-50 to-orange-50 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <ph-warning-octagon size="64" weight="duotone" class="text-red-600 mx-auto mb-4"></ph-warning-octagon>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Disclaimer
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    Important information regarding the use of GyaanGhar and its content.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 content-section">
            <div class="bg-white shadow-xl rounded-xl p-8 sm:p-10 text-gray-700">
                <p>Last updated: {{ date('F j, Y') }}</p>

                <h2>General Information</h2>
                <p>The information provided by <strong>GyaanGhar</strong> ("we," "us," or "our") on <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">{{ url('/') }}</a> (the "Site") is for general educational and informational purposes only. All information on the Site is provided in good faith, however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the Site.</p>

                <h2>Educational Content</h2>
                <p>GyaanGhar is a platform that allows educators (Teachers) to upload and share educational materials, including but not limited to documents, audio lectures, and quizzes, with their students. The content uploaded to GyaanGhar is created and managed by the respective Teachers or users. While we encourage accuracy and quality, <strong>GyaanGhar does not create, endorse, or verify the content uploaded by users.</strong></p>
                <p>We do not guarantee the accuracy, completeness, suitability, or validity of any information or educational material provided by users on the Site. Any reliance you place on such information is therefore strictly at your own risk.</p>

                <h2>No Professional Advice</h2>
                <p>The information available through the Site is for educational purposes only and is not intended as, and shall not be understood or construed as, professional advice (e.g., legal, medical, financial, etc.). The educational content provided by users does not constitute professional advice from GyaanGhar. You should consult with a qualified professional before making any decisions based on the information obtained from this Site.</p>

                <h2>External Links Disclaimer</h2>
                <p>The Site may contain (or you may be sent through the Site) links to other websites or content belonging to or originating from third parties or links to websites and features in banners or other advertising. Such external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability, or completeness by us. <strong>WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR THE ACCURACY OR RELIABILITY OF ANY INFORMATION OFFERED BY THIRD-PARTY WEBSITES LINKED THROUGH THE SITE OR ANY WEBSITE OR FEATURE LINKED IN ANY BANNER OR OTHER ADVERTISING.</strong> We will not be a party to or in any way be responsible for monitoring any transaction between you and third-party providers of products or services.</p>

                <h2>Errors and Omissions Disclaimer</h2>
                <p>While we strive to make the information on this Site as accurate as possible, the Site may contain errors or omissions. GyaanGhar will not be liable for any errors or omissions in the information provided on the Site, nor for the availability of this information. We are not responsible for any decisions you make based on the information presented on the Site.</p>

                <h2>Limitation of Liability</h2>
                <p>UNDER NO CIRCUMSTANCE SHALL WE HAVE ANY LIABILITY TO YOU FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF THE SITE OR RELIANCE ON ANY INFORMATION PROVIDED ON THE SITE. YOUR USE OF THE SITE AND YOUR RELIANCE ON ANY INFORMATION ON THE SITE IS SOLELY AT YOUR OWN RISK. GyaanGhar, its directors, employees, partners, agents, suppliers, or affiliates, will not be liable for any losses, injuries, or damages from the display or use of this information, whether direct, indirect, incidental, special, consequential, or punitive.</p>

                <h2>User-Generated Content</h2>
                <p>GyaanGhar allows users (Teachers) to upload content. We are not responsible for the content uploaded by users. The views and opinions expressed in user-generated content are those of the authors and do not necessarily reflect the official policy or position of GyaanGhar.</p>

                <h2>Changes to This Disclaimer</h2>
                <p>We reserve the right to make changes to this Disclaimer at any time and for any reason. We will alert you about any changes by updating the "Last updated" date of this Disclaimer. You are encouraged to periodically review this Disclaimer to stay informed of updates. You will be deemed to have been made aware of, will be subject to, and will be deemed to have accepted the changes in any revised Disclaimer by your continued use of the Site after the date such revised Disclaimer is posted.</p>

                <h2>Contact Us</h2>
                <p>If you have any questions about this Disclaimer, please contact us at <a href="mailto:gyaanghar@comperify.com" class="text-indigo-600 hover:underline">gyaanghar@comperify.com</a> or through our <a href="/contact-us" class="text-indigo-600 hover:underline">contact page</a>.</p>

                 <div class="mt-10 text-center">
                    <a href="/"
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <ph-house size="20" weight="bold" class="mr-2"></ph-house>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 w-full">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                 <a href="/" class="flex items-center mb-4">
                    <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Footer Logo" class="h-10 sm:h-12 mr-2">
                    <span class="text-xl sm:text-2xl font-bold text-white">GyaanGhar</span>
                </a>
                <p class="text-sm text-gray-400">Empowering education through accessible technology. Your digital house of knowledge.</p>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-3 border-b border-gray-700 pb-2">Quick Links</h3>
                <ul class="space-y-2 text-sm grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <li><a href="/privacy-policy" class="hover:text-blue-400 transition duration-200">Privacy Policy</a></li>
                    <li><a href="/about-us" class="hover:text-blue-400 transition duration-200">About Us</a></li>
                    <li><a href="/contact-us" class="hover:text-blue-400 transition duration-200">Contact Us</a></li>
                    <li><a href="/disclaimer" class="hover:text-blue-400 transition duration-200">Disclaimer</a></li>
                    <li><a href="/terms-and-conditions" class="hover:text-blue-400 transition duration-200">Terms & Conditions</a></li>
                    <li><a href="/review" class="hover:text-blue-400 transition duration-200">Leave a Review</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center py-6 border-t border-gray-700 text-sm text-gray-400">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </div>
    </footer>

</body>
</html>