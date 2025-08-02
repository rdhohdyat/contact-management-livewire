<main class="container mx-auto px-4">
    <div class="flex-grow flex items-center justify-center">
        <div
            class="bg-gray-800 bg-opacity-80 rounded-xl shadow-custom border border-gray-700 overflow-hidden max-w-2xl mx-auto animate-fade-in p-8 text-center">
            <div>
                <div class="w-32 h-32 bg-gradient rounded-full mx-auto flex items-center justify-center mb-6 shadow-lg">
                    <i class="fas fa-exclamation-triangle text-6xl text-white"></i>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4">404</h1>
                <h2 class="text-2xl font-semibold text-white mb-4">Page Not Found</h2>
                <p class="text-gray-300 mb-8">The page you are looking for doesn't exist or has been moved.</p>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 font-medium shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-home mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</main>