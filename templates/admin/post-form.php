<?php
$post = $post ?? null;
$error = $error ?? null;
$isEditing = isset($post);
$page_title = $isEditing ? 'Edit Post - travelNepal Admin' : 'New Post - travelNepal Admin';
$page_description = $isEditing ? 'Edit your Nepal travel blog post' : 'Create a new Nepal travel blog post';

ob_start();
?>

<!-- Include Admin Sidebar -->
<?php include __DIR__ . '/../components/admin-sidebar.php'; ?>

<!-- Main Content Area (with sidebar padding) -->
<div class="lg:ml-64">

<div class="min-h-screen bg-mountain-50">
    <!-- Header -->
    <div class="bg-white border-b border-mountain-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-mountain-800">
                        <?php echo $isEditing ? 'Edit Post' : 'Create New Post'; ?>
                    </h1>
                    <p class="text-mountain-600 mt-1">
                        <?php echo $isEditing ? 'Update your Nepal travel story' : 'Share your Nepal adventure with the world'; ?>
                    </p>
                </div>
                <a href="<?php echo siteUrl('admin/dashboard'); ?>" class="text-mountain-600 hover:text-nepal-600 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-lg">
            <form method="POST" action="<?php echo siteUrl('admin/post/save'); ?>" enctype="multipart/form-data" class="p-8 space-y-8" id="post-form">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <?php if ($isEditing): ?>
                <input type="hidden" name="slug" value="<?php echo htmlspecialchars($post['slug'] ?? ''); ?>">
                <?php endif; ?>

                <?php if (isset($error)): ?>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-heading mr-2"></i>Title
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           required 
                           value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>"
                           class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent text-lg"
                           placeholder="Enter an engaging title for your post">
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-quote-left mr-2"></i>Excerpt
                    </label>
                    <textarea id="excerpt" 
                              name="excerpt" 
                              required 
                              rows="3"
                              class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent resize-none"
                              placeholder="Write a compelling excerpt that will appear on the blog listing..."><?php echo htmlspecialchars($post['excerpt'] ?? ''); ?></textarea>
                </div>

                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium text-mountain-700 mb-4">
                        <i class="fas fa-image mr-2"></i>Featured Image
                    </label>
                    
                    <!-- Upload Option -->
                    <div class="mb-4">
                        <label for="image_upload" class="block text-sm font-medium text-mountain-600 mb-2">
                            <i class="fas fa-upload mr-2"></i>Upload Image
                        </label>
                        <input type="file" 
                               id="image_upload" 
                               name="image_upload" 
                               <?php echo !$isEditing ? 'required' : ''; ?>
                               accept=".jpg,.jpeg,.png,.webp"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-nepal-50 file:text-nepal-700 hover:file:bg-nepal-100">
                        <p class="mt-2 text-sm text-mountain-500">
                            <strong>Allowed:</strong> JPEG, PNG, WebP • <strong>Max size:</strong> 50MB
                            <?php if (!$isEditing): ?><br><strong>Required:</strong> You must upload an image for new posts<?php else: ?><br><strong>Optional:</strong> Upload a new image to replace the current one<?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Gallery Images -->
                <div>
                    <label class="block text-sm font-medium text-mountain-700 mb-4">
                        <i class="fas fa-images mr-2"></i>Gallery Images
                    </label>
                    
                    <div class="mb-4">
                        <label for="gallery_images" class="block text-sm font-medium text-mountain-600 mb-2">
                            <i class="fas fa-upload mr-2"></i>Upload Additional Images
                        </label>
                        <input type="file" 
                               id="gallery_images" 
                               name="gallery_images[]" 
                               multiple
                               accept=".jpg,.jpeg,.png,.webp"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-nepal-50 file:text-nepal-700 hover:file:bg-nepal-100"
                               onchange="previewGalleryImages(this)">
                        <p class="mt-2 text-sm text-mountain-500">
                            <strong>Optional:</strong> Upload multiple images for your blog post gallery • 
                            <strong>Allowed:</strong> JPEG, PNG, WebP • <strong>Max size:</strong> 50MB each
                        </p>
                    </div>

                    <!-- Gallery Images Preview -->
                    <div id="gallery-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4"></div>

                    <!-- Existing Gallery Images (for editing) -->
                    <?php if ($isEditing): ?>
                    <?php 
                    $postId = getPostIdFromSlug($post['slug']);
                    $existingImages = $postId ? loadPostImages($postId) : [];
                    if (!empty($existingImages)): 
                    ?>
                    <div class="mt-6">
                        <h4 class="text-sm font-medium text-mountain-700 mb-3">Current Gallery Images</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="existing-gallery">
                            <?php foreach ($existingImages as $image): ?>
                            <div class="relative group" data-image-id="<?php echo $image['id']; ?>">
                                <img src="<?php echo ensureFullImageUrl(htmlspecialchars($image['image_url'])); ?>" 
                                 alt="<?php echo htmlspecialchars($image['alt_text'] ?: 'Gallery image'); ?>"
                                 class="w-full h-24 object-cover rounded-lg border border-mountain-200">
                                <button type="button" 
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity"
                                        onclick="removeExistingImage(<?php echo $image['id']; ?>)"
                                        title="Remove image">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Category and Tags Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-tag mr-2"></i>Category
                        </label>
                        <select id="category" 
                                name="category" 
                                required
                                class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                            <option value="">Select a category</option>
                            <?php
                            $categories = getCategories();
                            foreach ($categories as $category):
                            ?>
                            <option value="<?php echo htmlspecialchars($category['name']); ?>" <?php echo (($post['category'] ?? '') === $category['name']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-mountain-700 mb-2">
                            <i class="fas fa-tags mr-2"></i>Tags
                        </label>
                        <input type="text" 
                               id="tags" 
                               name="tags" 
                               value="<?php echo htmlspecialchars(implode(', ', $post['tags'] ?? [])); ?>"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent"
                               placeholder="Everest, Trekking, Adventure (separated by commas)">
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-file-alt mr-2"></i>Content
                    </label>
                    <textarea id="content" 
                              name="content" 
                              required 
                              rows="20"
                              class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent font-mono text-sm"
                              placeholder="Write your amazing Nepal travel story here... You can use HTML tags for formatting."><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
                    <div class="mt-2 text-sm text-mountain-500">
                        <strong>HTML Tips:</strong> Use &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt; tags for formatting.
                    </div>
                </div>

                <!-- Publishing Options -->
                <div class="border-t border-mountain-200 pt-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="published" 
                                   name="published" 
                                   <?php echo ($post['published'] ?? false) ? 'checked' : ''; ?>
                                   class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded">
                            <label for="published" class="ml-2 block text-sm font-medium text-mountain-700">
                                <i class="fas fa-globe mr-2"></i>
                                Publish this post (make it visible to visitors)
                            </label>
                        </div>
                        
                        <div class="flex space-x-4">
                            <a href="<?php echo siteUrl('admin/dashboard'); ?>" 
                               class="bg-mountain-200 text-mountain-700 px-6 py-3 rounded-lg font-semibold hover:bg-mountain-300 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg" 
                                    id="save-btn">
                                <i class="fas fa-save mr-2"></i>
                                <?php echo $isEditing ? 'Update Post' : 'Save Post'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg p-8">
            <h3 class="text-lg font-semibold text-mountain-800 mb-4">
                <i class="fas fa-eye mr-2"></i>Live Preview
            </h3>
            <div class="border border-mountain-200 rounded-lg p-6 bg-mountain-50">
                <div id="preview-content">
                    <div class="text-center text-mountain-500 py-8">
                        <i class="fas fa-eye-slash text-3xl mb-2"></i>
                        <p>Start typing to see a preview of your post</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const excerptInput = document.getElementById('excerpt');
    const contentInput = document.getElementById('content');
    const categoryInput = document.getElementById('category');
    const previewContent = document.getElementById('preview-content');

    function updatePreview() {
        const title = titleInput.value || 'Your Post Title';
        const excerpt = excerptInput.value || 'Your post excerpt will appear here...';
        const content = contentInput.value || '<p>Start writing your amazing Nepal travel story...</p>';
        const category = categoryInput.value || 'Category';

        previewContent.innerHTML = `
            <div class="bg-white rounded-lg p-6">
                <div class="mb-4">
                    <span class="bg-nepal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                        ${category}
                    </span>
                </div>
                <h2 class="text-2xl font-bold text-mountain-800 mb-3">${title}</h2>
                <p class="text-mountain-600 mb-4 italic">${excerpt}</p>
                <div class="prose prose-mountain max-w-none">
                    ${content}
                </div>
            </div>
        `;
    }

    // Update preview on input
    titleInput.addEventListener('input', updatePreview);
    excerptInput.addEventListener('input', updatePreview);
    contentInput.addEventListener('input', updatePreview);
    categoryInput.addEventListener('change', updatePreview);

    // Initial preview update
    updatePreview();

    // Form submission with loading state
    document.getElementById('post-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('save-btn');
        const resetLoading = showLoading(btn);
    });

    // Auto-resize textareas
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    excerptInput.addEventListener('input', function() {
        autoResize(this);
    });

    // Character counter for excerpt
    const excerptCounter = document.createElement('div');
    excerptCounter.className = 'text-sm text-mountain-500 mt-1';
    excerptInput.parentNode.appendChild(excerptCounter);

    excerptInput.addEventListener('input', function() {
        const length = this.value.length;
        excerptCounter.textContent = `${length} characters (recommended: 120-160)`;
        
        if (length > 160) {
            excerptCounter.className = 'text-sm text-red-500 mt-1';
        } else if (length >= 120) {
            excerptCounter.className = 'text-sm text-green-600 mt-1';
        } else {
            excerptCounter.className = 'text-sm text-mountain-500 mt-1';
        }
    });

    // Initial character count
    excerptInput.dispatchEvent(new Event('input'));
});

// Gallery Images Functions
function previewGalleryImages(input) {
    const previewContainer = document.getElementById('gallery-preview');
    previewContainer.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group';
                    imageDiv.innerHTML = `
                        <img src="${e.target.result}" 
                             alt="Gallery preview" 
                             class="w-full h-24 object-cover rounded-lg border border-mountain-200">
                        <div class="absolute top-1 right-1 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                            ${i + 1}
                        </div>
                    `;
                    previewContainer.appendChild(imageDiv);
                };
                
                reader.readAsDataURL(file);
            }
        }
    }
}

// Array to track images marked for deletion
let imagesToDelete = [];

function removeExistingImage(imageId) {
    if (confirm('Are you sure you want to remove this image from the gallery?')) {
        // Hide the image element
        const imageDiv = document.querySelector(`[data-image-id="${imageId}"]`);
        if (imageDiv) {
            imageDiv.style.display = 'none';
            
            // Add to deletion list
            if (!imagesToDelete.includes(imageId)) {
                imagesToDelete.push(imageId);
            }
            
            // Add hidden input to track deletions
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'delete_images[]';
            hiddenInput.value = imageId;
            document.getElementById('post-form').appendChild(hiddenInput);
        }
    }
}

</script>

<style>
.prose h2 {
    @apply text-2xl font-bold text-mountain-800 mt-8 mb-4;
}

.prose h3 {
    @apply text-xl font-bold text-mountain-800 mt-6 mb-3;
}

.prose p {
    @apply mb-4 leading-relaxed text-mountain-700;
}

.prose ul, .prose ol {
    @apply mb-4 ml-6;
}

.prose li {
    @apply mb-2 leading-relaxed text-mountain-700;
}

.prose strong {
    @apply font-semibold text-mountain-800;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

#content {
    min-height: 400px;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
}
</style>

</div> <!-- End Main Content Area -->

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/admin-layout.php';
?>