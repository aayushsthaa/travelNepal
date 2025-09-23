<?php
// Initialize variables to prevent undefined variable warnings
$destination = $destination ?? null;
$error = $error ?? null;
$isEditing = isset($destination);
$page_title = $isEditing ? 'Edit Destination - travelNepal Admin' : 'New Destination - travelNepal Admin';
$page_description = $isEditing ? 'Edit your Nepal travel destination' : 'Create a new Nepal travel destination';

ob_start();
?>

<div class="min-h-screen bg-mountain-50">
    <!-- Header -->
    <div class="bg-white border-b border-mountain-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-mountain-800">
                        <?php echo $isEditing ? 'Edit Destination' : 'Create New Destination'; ?>
                    </h1>
                    <p class="text-mountain-600 mt-1">
                        <?php echo $isEditing ? 'Update your Nepal travel destination' : 'Add a new amazing destination to Nepal'; ?>
                    </p>
                </div>
                <a href="/admin/dashboard" class="text-mountain-600 hover:text-nepal-600 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-lg">
            <form method="POST" action="/admin/destination/save" enctype="multipart/form-data" class="p-8 space-y-8" id="destination-form">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <?php if ($isEditing): ?>
                <input type="hidden" name="slug" value="<?php echo htmlspecialchars($destination['slug'] ?? ''); ?>">
                <?php endif; ?>

                <?php if (isset($error)): ?>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-map-pin mr-2"></i>Destination Name *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required 
                               value="<?php echo htmlspecialchars($destination['name'] ?? ''); ?>"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent text-lg"
                               placeholder="Enter destination name">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-tags mr-2"></i>Category
                        </label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                            <option value="">Select category</option>
                            <?php
                            $categories = getDestinationCategories();
                            foreach ($categories as $category):
                            ?>
                            <option value="<?php echo htmlspecialchars($category); ?>" 
                                    <?php echo isset($destination['category']) && $destination['category'] === $category ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-quote-left mr-2"></i>Short Description *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              required 
                              rows="3"
                              class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent resize-none"
                              placeholder="Brief description for destination cards (150-200 characters)"><?php echo htmlspecialchars($destination['description'] ?? ''); ?></textarea>
                </div>

                <!-- Long Description -->
                <div>
                    <label for="long_description" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-align-left mr-2"></i>Detailed Description
                    </label>
                    <textarea id="long_description" 
                              name="long_description" 
                              rows="8"
                              class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                              placeholder="Detailed description about the destination, its attractions, and what makes it special"><?php echo htmlspecialchars($destination['long_description'] ?? ''); ?></textarea>
                </div>

                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-image mr-2"></i>Featured Image
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="featured_image" class="block text-xs text-mountain-600 mb-1">Image URL</label>
                            <input type="url" 
                                   id="featured_image" 
                                   name="featured_image" 
                                   value="<?php echo htmlspecialchars($destination['featured_image'] ?? ''); ?>"
                                   class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                        <div>
                            <label for="image_upload" class="block text-xs text-mountain-600 mb-1">Or Upload Image</label>
                            <input type="file" 
                                   id="image_upload" 
                                   name="image_upload" 
                                   accept="image/jpeg,image/png,image/webp"
                                   class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Location Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="region" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-map-marked-alt mr-2"></i>Region
                        </label>
                        <select id="region" 
                                name="region" 
                                class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                            <option value="">Select region</option>
                            <?php
                            $regions = getDestinationRegions();
                            foreach ($regions as $region):
                            ?>
                            <option value="<?php echo htmlspecialchars($region); ?>" 
                                    <?php echo isset($destination['region']) && $destination['region'] === $region ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($region); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="altitude_range" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-mountain mr-2"></i>Altitude Range
                        </label>
                        <input type="text" 
                               id="altitude_range" 
                               name="altitude_range" 
                               value="<?php echo htmlspecialchars($destination['altitude_range'] ?? ''); ?>"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                               placeholder="e.g., 2800m-5364m">
                    </div>

                    <div>
                        <label for="difficulty_level" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-signal mr-2"></i>Difficulty Level
                        </label>
                        <select id="difficulty_level" 
                                name="difficulty_level" 
                                class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                            <option value="">Select difficulty</option>
                            <?php
                            $difficulties = getDifficultyLevels();
                            foreach ($difficulties as $difficulty):
                            ?>
                            <option value="<?php echo htmlspecialchars($difficulty); ?>" 
                                    <?php echo isset($destination['difficulty_level']) && $destination['difficulty_level'] === $difficulty ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($difficulty); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Trip Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="duration" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-clock mr-2"></i>Duration
                        </label>
                        <input type="text" 
                               id="duration" 
                               name="duration" 
                               value="<?php echo htmlspecialchars($destination['duration'] ?? ''); ?>"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                               placeholder="e.g., 14-16 days, 2-3 days">
                    </div>

                    <div>
                        <label for="best_time_to_visit" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>Best Time to Visit
                        </label>
                        <input type="text" 
                               id="best_time_to_visit" 
                               name="best_time_to_visit" 
                               value="<?php echo htmlspecialchars($destination['best_time_to_visit'] ?? ''); ?>"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                               placeholder="e.g., March-May, September-November">
                    </div>
                </div>

                <!-- Lists -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="highlights" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-star mr-2"></i>Highlights
                        </label>
                        <textarea id="highlights" 
                                  name="highlights" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                                  placeholder="Key attractions separated by commas"><?php echo isset($destination['highlights']) ? implode(', ', $destination['highlights']) : ''; ?></textarea>
                    </div>

                    <div>
                        <label for="activities" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-hiking mr-2"></i>Activities
                        </label>
                        <textarea id="activities" 
                                  name="activities" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                                  placeholder="Available activities separated by commas"><?php echo isset($destination['activities']) ? implode(', ', $destination['activities']) : ''; ?></textarea>
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <label for="transportation_info" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-route mr-2"></i>Transportation Information
                    </label>
                    <textarea id="transportation_info" 
                              name="transportation_info" 
                              rows="3"
                              class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                              placeholder="How to get there, transportation options"><?php echo htmlspecialchars($destination['transportation_info'] ?? ''); ?></textarea>
                </div>

                <!-- Checkboxes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="entry_permits_required" 
                                   name="entry_permits_required" 
                                   class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded"
                                   <?php echo isset($destination['entry_permits_required']) && $destination['entry_permits_required'] ? 'checked' : ''; ?>>
                            <label for="entry_permits_required" class="ml-2 block text-sm text-mountain-700">
                                Entry permits required
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="accommodation_available" 
                                   name="accommodation_available" 
                                   class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded"
                                   <?php echo !isset($destination['accommodation_available']) || $destination['accommodation_available'] ? 'checked' : ''; ?>>
                            <label for="accommodation_available" class="ml-2 block text-sm text-mountain-700">
                                Accommodation available
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="featured" 
                                   name="featured" 
                                   class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded"
                                   <?php echo isset($destination['featured']) && $destination['featured'] ? 'checked' : ''; ?>>
                            <label for="featured" class="ml-2 block text-sm text-mountain-700">
                                Featured destination
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="published" 
                                   name="published" 
                                   class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded"
                                   <?php echo !isset($destination['published']) || $destination['published'] ? 'checked' : ''; ?>>
                            <label for="published" class="ml-2 block text-sm text-mountain-700">
                                Published
                            </label>
                        </div>
                    </div>
                </div>

                <!-- SEO Fields -->
                <div class="border-t pt-8">
                    <h3 class="text-lg font-medium text-mountain-800 mb-4">SEO Settings</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-mountain-700 mb-2">
                                Meta Title
                            </label>
                            <input type="text" 
                                   id="meta_title" 
                                   name="meta_title" 
                                   value="<?php echo htmlspecialchars($destination['meta_title'] ?? $destination['name'] ?? ''); ?>"
                                   class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                                   placeholder="SEO title for search engines">
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-mountain-700 mb-2">
                                Meta Description
                            </label>
                            <textarea id="meta_description" 
                                      name="meta_description" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                                      placeholder="SEO description for search engines (150-160 characters)"><?php echo htmlspecialchars($destination['meta_description'] ?? $destination['description'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="/admin/dashboard" class="text-mountain-600 hover:text-mountain-800 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Cancel
                    </a>
                    
                    <div class="flex space-x-4">
                        <button type="submit" name="action" value="draft" 
                                class="bg-mountain-500 hover:bg-mountain-600 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Save as Draft
                        </button>
                        
                        <button type="submit" name="action" value="publish" 
                                class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fas fa-globe mr-2"></i>
                            <?php echo $isEditing ? 'Update Destination' : 'Publish Destination'; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include TEMPLATES_PATH . '/layout.php';
?>