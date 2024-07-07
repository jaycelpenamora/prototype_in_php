<?php include $this->resolve("partials/_header.php"); ?>

<!-- Start Main Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
  <div class="flex items-center justify-between border-b border-gray-200 pb-4">
    <h3 class="font-medium">Browse</h3>
  </div>
  <!-- Search Form -->
  <form method="GET" class="mt-4 w-full">
    <div class="flex">
      <input value="<?php echo e((string)$searchTerm); ?>" name="s" type="text" class="w-full rounded-l-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search a title" />
      <button type="submit" class="rounded-r-md bg-navy px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Search
      </button>
    </div>
  </form>
  <!-- Body -->
  <!-- Transaction Table Body -->
  <?php include $this->resolve("partials/_csrf.php"); ?>
  <div class="flex-row divide-y divide-gray-200 bg-white">
    <?php foreach ($results as $result) : ?>
      <input type="hidden" />
      <div class="container-s mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
        <img src="<?php echo e($result['thumbnail_url']); ?>" alt="" class="thumbnail">
        <div class="text-xl">
          <?php echo e($result['title']); ?>
        </div>
        <div class="text-sm text-gray-600">
          Year Released: <?php echo e($result['release_date']); ?>
        </div>
        <div class="text-sm text-gray-600">
          <?php echo e($result['genre']); ?>
        </div>
        <div class="text-sm text-gray-600">
          Language: <?php echo e($result['language']); ?>
        </div>
        <div class="text-sm text-gray-600">
          One month access: <?php echo e($result['rental_price']); ?>
        </div>
        <a href="/add/<?php echo e($result['movie_id']); ?>" class="flex-column width-tiny">
          <button type="submit" onclick="return confirm('Confirm purchase?')" class="p-2 bg-emerald-50 text-xs text-emerald-900 hover:bg-emerald-500 hover:text-white transition rounded">
            Rent
          </button>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 mt-6">
    <!-- Previous Page Link -->
    <div class="-mt-px flex w-0 flex-1">
      <?php if ($currentPage > 1) : ?>
        <a href="/rent?<?php echo e($previousPageQuery); ?> " class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
          <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
          </svg>
          Previous
        </a>
      <?php endif; ?>
    </div>
    <!-- Pages Link -->
    <div class="hidden md:-mt-px md:flex">
      <?php foreach ($pageLinks as $pageNum => $query) : ?>
        <a href="/rent?<?php echo e($query); ?>" class="<?php echo $pageNum + 1 === $currentPage ? "border-indigo-500 text-indigo-600" : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" ?>inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium">
          <?php echo e($pageNum + 1); ?>
        </a>
      <?php endforeach; ?>
      <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
    </div>
    <!-- Next Page Link -->
    <div class="-mt-px flex w-0 flex-1 justify-end">
      <?php if ($currentPage < $lastPage) : ?>
        <a href="/rent?<?php echo e($nextPageQuery); ?>" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
          Next
          <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
          </svg>
        </a>
      <?php endif; ?>
    </div>
  </nav>
</section>
<!-- End Main Content Area -->

<?php include $this->resolve("partials/_footer.php"); ?>
