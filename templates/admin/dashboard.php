<?php
$page_title = 'Admin Dashboard - travelNepal';
$page_description = 'Manage your Nepal travel blog posts and content.';

ob_start();
?>

<!-- Dashboard Header -->
<div class="bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center">
            <div class="animate-fade-in-down">
                <h1 class="text-3xl font-display font-bold mb-2">Admin Dashboard</h1>
                <p class="opacity-90">Manage your Nepal travel content</p>
            </div>
            <div class="animate-fade-in-up">
                <a href="/admin/post/create" class="bg-white text-nepal-600 hover:text-nepal-700 px-6 py-3 rounded-lg font-semibold transition-colors inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    New Post
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Stats -->
<div class="bg-white border-b border-mountain-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 animate-on-scroll">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-600 text-sm font-medium">Total Posts</p>
                        <p class="text-2xl font-bold text-blue-800"><?php echo count($posts); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 animate-on-scroll">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-600 text-sm font-medium">Published</p>
                        <p class="text-2xl font-bold text-green-800">
                            <?php echo count(array_filter($posts, function($p) { return $p['published']; })); ?>
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 animate-on-scroll">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-600 text-sm font-medium">Drafts</p>
                        <p class="text-2xl font-bold text-yellow-800">
                            <?php echo count(array_filter($posts, function($p) { return !$p['published']; })); ?>
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-white"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 animate-on-scroll">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-600 text-sm font-medium">Categories</p>
                        <p class="text-2xl font-bold text-purple-800">
                            <?php echo count(array_unique(array_column($posts, 'category'))); ?>
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-tags text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Posts Management -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-mountain-50 border-b border-mountain-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-mountain-800">Blog Posts</h2>
                <div class="flex space-x-2">
                    <select class="px-4 py-2 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Trekking">Trekking</option>
                        <option value="Culture">Culture</option>
                        <option value="Adventure">Adventure</option>
                    </select>
                    <select class="px-4 py-2 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>
        </div>

        <?php if (!empty($posts)): ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-mountain-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-mountain-500 uppercase tracking-wider">Post</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-mountain-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-mountain-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-mountain-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-mountain-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-mountain-200">
                    <?php foreach ($posts as $post): ?>
                    <tr class="post-row hover:bg-mountain-50 transition-colors" data-category="<?php echo htmlspecialchars($post['category']); ?>" data-status="<?php echo $post['published'] ? 'published' : 'draft'; ?>">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?>"
                                     class="w-16 h-12 rounded-lg object-cover mr-4">
                                <div>
                                    <div class="text-sm font-medium text-mountain-900">
                                        <?php echo htmlspecialchars(truncateText($post['title'], 60)); ?>
                                    </div>
                                    <div class="text-sm text-mountain-500">
                                        <?php echo htmlspecialchars(truncateText($post['excerpt'], 80)); ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-nepal-100 text-nepal-800">
                                <?php echo htmlspecialchars($post['category']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $post['published'] ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                <i class="fas <?php echo $post['published'] ? 'fa-check-circle' : 'fa-clock'; ?> mr-1"></i>
                                <?php echo $post['published'] ? 'Published' : 'Draft'; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-mountain-500">
                            <?php echo formatDate($post['created_at']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors" 
                                   title="View Post" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/post/edit/<?php echo htmlspecialchars($post['slug']); ?>" 
                                   class="text-nepal-600 hover:text-nepal-900 transition-colors" 
                                   title="Edit Post">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete('<?php echo htmlspecialchars($post['slug']); ?>', '<?php echo htmlspecialchars($post['title']); ?>')" 
                                        class="text-red-600 hover:text-red-900 transition-colors" 
                                        title="Delete Post">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-file-alt text-mountain-300 text-6xl mb-4"></i>
            <h3 class="text-lg font-medium text-mountain-700 mb-2">No posts yet</h3>
            <p class="text-mountain-500 mb-6">Start creating amazing Nepal travel content!</p>
            <a href="/admin/post/create" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Your First Post
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md mx-4 animate-fade-in-up">
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-mountain-800 mb-2">Delete Post</h3>
            <p class="text-mountain-600 mb-6">
                Are you sure you want to delete "<span id="deletePostTitle"></span>"? This action cannot be undone.
            </p>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" class="flex-1 bg-mountain-200 text-mountain-700 py-2 px-4 rounded-lg hover:bg-mountain-300 transition-colors">
                    Cancel
                </button>
                <button onclick="deletePost()" class="flex-1 bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentDeleteSlug = '';

function confirmDelete(slug, title) {
    currentDeleteSlug = slug;
    document.getElementById('deletePostTitle').textContent = title;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    currentDeleteSlug = '';
}

function deletePost() {
    if (currentDeleteSlug) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/post/delete/${currentDeleteSlug}`;
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = 'csrf_token';
        csrfInput.value = '<?php echo generateCSRFToken(); ?>';
        form.appendChild(csrfInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');
    const postRows = document.querySelectorAll('.post-row');

    function filterPosts() {
        const selectedCategory = categoryFilter.value;
        const selectedStatus = statusFilter.value;

        postRows.forEach(row => {
            const rowCategory = row.dataset.category;
            const rowStatus = row.dataset.status;

            const categoryMatch = !selectedCategory || rowCategory === selectedCategory;
            const statusMatch = !selectedStatus || rowStatus === selectedStatus;

            if (categoryMatch && statusMatch) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    categoryFilter.addEventListener('change', filterPosts);
    statusFilter.addEventListener('change', filterPosts);
});

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/layout.php';
?>