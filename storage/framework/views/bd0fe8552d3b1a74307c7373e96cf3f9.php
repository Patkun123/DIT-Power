<?php $__env->startSection('title', 'Nutrition'); ?>
<?php $__env->startSection('content'); ?>



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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.users.partials.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/auth/users/view/nutrition.blade.php ENDPATH**/ ?>