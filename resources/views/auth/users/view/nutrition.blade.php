@extends('auth.users.partials.app.head')

@section('title', 'Nutrition')
@section('content')

{{-- <div class="p-10 sm:p-6 lg:p-20 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen overflow-x-hidden">
    <h1 class="text-2xl font-bold text-center mb-6">Your Meal Plans</h1>
    <div class="border-t-2 border-primary-500 w-40 mx-auto mb-8"></div>

    <div class="grid grid-cols-1  md:grid-cols-2 gap-6">
        <!-- Weekly Meal Plan -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="flex items-center text-lg font-semibold mb-4">
                <svg class="w-5 h-5 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v7a2 2 0 002 2h12a2 2 0 002-2V9zM7 11a1 1 0 012 0v3a1 1 0 11-2 0v-3zm4 0a1 1 0 012 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path>
                </svg>
                Weekly Meal Plan
            </h2>

            @foreach(['Breakfast', 'Lunch', 'Dinner', 'Snacks'] as $meal)
                <button class="flex justify-between items-center w-full p-3 bg-gray-100 rounded mb-2 hover:bg-gray-200">
                    <span>{{ $meal }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @endforeach

            <button class="mt-4 w-full bg-primary-500 hover:bg-primary-600 text-white py-2 px-4 rounded">
                View Full Plan
            </button>
        </div>
        <!-- Upcoming Workshops -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="flex items-center text-lg font-semibold mb-4">
                <svg class="w-5 h-5 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v7a2 2 0 002 2h12a2 2 0 002-2V9zM7 11a1 1 0 012 0v3a1 1 0 11-2 0v-3zm4 0a1 1 0 012 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path>
                </svg>
                Upcoming Workshops
            </h2>

            @php
                $workshops = [
                    ['title' => 'Healthy Meal Prep Basics', 'desc' => 'Learn how to prepare nutritious meals for the week', 'date' => 'June 15, 2024 - 2:00 PM'],
                    ['title' => 'Understanding Nutrition Labels', 'desc' => 'Master reading and understanding food labels', 'date' => 'June 20, 2024 - 3:00 PM'],
                    ['title' => 'Balanced Diet Planning', 'desc' => 'Create your personalized balanced diet plan', 'date' => 'June 25, 2024 - 1:00 PM'],
                ];
            @endphp

            @foreach($workshops as $workshop)
                <div class="bg-gray-800 rounded p-4 mb-3 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold">{{ $workshop['title'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $workshop['desc'] }}</p>
                        <p class="text-primary-600 font-medium mt-1">{{ $workshop['date'] }}</p>
                    </div>
                    <button class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded">
                        Register
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}

<section class="dark:text-gray-50 dark:bg-gray-900 body-font">
  <div class="container px-5 py-10 mx-auto flex flex-col">
    <div class="lg:w-4/6 mx-auto">
      <!-- Flowbite Responsive Video Embed -->
        <h1 class="text-3xl font-bold text-center mb-6">The Healthy Eating Pyramid</h1>
        <div class="border-t-2 border-primary-500 w-40 mx-auto mb-8"></div>
      <div class="relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;">
        <iframe
          class="absolute top-0 left-0 w-full h-full rounded-lg"
          src="https://www.youtube.com/embed/kdzxcYq8jdU?autoplay=1&controls=1"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>

      <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-start sm:pr-8 sm:py-8">
          <div class="flex flex-col items-center text-center justify-center">
            <h2 class="font-medium title-font mt-4 text-gray-900 dark:text-gray-50 text-lg">The Healthy Eating Food Pyramid</h2>
            <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
            <p class="text-base">Raclette knausgaard hella meggs normcore williamsburg enamel pin sartorial venmo tbh hot chicken gentrify portland.</p>
          </div>
        </div>
        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
          <p class="leading-relaxed text-lg mb-4">Balanced diet is a key to stay healthy. Follow the "Healthy Eating Food Pyramid" guide as you pick your food. Grains should be taken as the most. Eat more fruit and vegetables. Have a moderate amount of meat, fish, egg, milk and their alternatives. Reduce fat/ oil, salt and sugar. Trim fat from meat before cooking. Cook with low-fat methods such as steaming, stewing, simmering, boiling, scalding or cooking with non-stick frying pans. Also reduce the use of frying and deep-frying. These can help us achieve a balanced diet and promote health.</p>
          <a href="https://www.chp.gov.hk/en/static/90017.html" class="text-indigo-500 inline-flex items-center">Learn More
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="bg-white dark:bg-gray-900">
    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Food pyramid</h2>
            <p class="mb-4"> a visual representation (in the shape of a pyramid) of the optimal number of servings of food a person should eat daily from each basic food group. The food pyramid first evolved in Sweden in the 1970s and was adapted by the U.S. Department of Agriculture (USDA) in 1992. The USDA revised it in 2005 to create what it called MyPyramid, which was replaced by MyPlate in 2011. Many countries across the globe have adapted versions of the food pyramid, sometimes discarding the pyramid shape altogether. Whatever form they take, such food guides are intended to help people cultivate a daily pattern of recommended (and thus presumably healthy) food choices.</p>
            <p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-8">
            <img class="w-full rounded-lg" src="/images/pic/47172.jpg" alt="office content 1">
            <img class="mt-4 w-full lg:mt-10 rounded-lg" src="/images/pic/47172.jpg" alt="office content 2">
        </div>
    </div>
</section>
@endsection
