<?php include $this->resolve("partials/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
  <form method="POST" class="grid grid-cols-1 gap-6">
    <?php include $this->resolve('partials/_csrf.php'); ?>
    <!-- username -->
    <label class="block">
      <span class="text-gray-700">Create Username</span>
      <input value="<?php echo e($oldFormData['username'] ?? ''); ?>" name="username" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('username', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['username'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Email -->
    <label class="block">
      <span class="text-gray-700">Email address</span>
      <input value="<?php echo e($oldFormData['email'] ?? ''); ?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com" />
      <?php if (array_key_exists('email', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['email'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Age -->
    <label class="block">
      <span class="text-gray-700">Age</span>
      <input value="<?php echo e($oldFormData['age'] ?? ''); ?>"name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('age', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['age'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Country -->
    <label class="block">
      <span class="text-gray-700">Country</span>
      <select value="<?php echo e($oldFormData['country'] ?? ''); ?>" name="country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="Philippines">Philippines</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Singapore">Singapore</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Invalid">Invalid Country</option>
      </select>
      <?php if (array_key_exists('country', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['country'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Password -->
    <label class="block">
      <span class="text-gray-700">Password</span>
      <input name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('password', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['password'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Confirm Password -->
    <label class="block">
      <span class="text-gray-700">Confirm Password</span>
      <input name="confirm_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('confirm_password', $errors)) : ?>
        <div class="bg-gray-100 mt-2 p-2 rounded text-red-500">
          <?php echo e($errors['confirm_password'][0]); ?>
        </div>
      <?php endif; ?>
    </label>
    <!-- Terms of Service -->
    <div class="block">
      <div class="mt-2">
        <div>
          <label class="inline-flex items-center">
            <input <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?> name="tos" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" type="checkbox" />
            <span class="ml-2">I accept the terms of service.</span>
          </label>
          <?php if (array_key_exists('tos', $errors)) : ?>
          <div class="bg-gray-100 mt-2 p-2 text-red-500">
            <?php echo e($errors['tos'][0]); ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <button type="submit" class="block w-full py-2 bg-navy text-white rounded">
      Register
    </button>
  </form>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>
