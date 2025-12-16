<?php
// products.php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

require __DIR__ . '/../config/db.php';
include __DIR__ . '/../templates/header.php';

// Phân trang client-side
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 12;

// Lấy danh mục từ query string (nếu có)
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$priceRange = isset($_GET['price']) ? $_GET['price'] : '';
?>

<main class="container py-5">
  <!-- Tiêu đề và breadcrumb -->
  <div class="shop-header mb-4">
    <h1 class="shop-title">Sản phẩm</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $base_url ?>index.php">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <!-- Sidebar - Bộ lọc -->
    <div class="col-lg-3 mb-4">
      <div class="filter-sidebar">
        <h5 class="filter-title"><i class="fas fa-filter"></i> Bộ lọc</h5>
        
        <!-- Lọc theo thương hiệu -->
        <div class="filter-group">
          <h6 class="filter-group-title">Thương hiệu</h6>
          <div class="filter-options">
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="iphone" id="cat-iphone" <?= $category === 'iphone' ? 'checked' : '' ?>>
              <label class="form-check-label" for="cat-iphone">iPhone</label>
            </div>
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="samsung" id="cat-samsung" <?= $category === 'samsung' ? 'checked' : '' ?>>
              <label class="form-check-label" for="cat-samsung">Samsung</label>
            </div>
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="xiaomi" id="cat-xiaomi" <?= $category === 'xiaomi' ? 'checked' : '' ?>>
              <label class="form-check-label" for="cat-xiaomi">Xiaomi</label>
            </div>
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="oppo" id="cat-oppo">
              <label class="form-check-label" for="cat-oppo">OPPO</label>
            </div>
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="vivo" id="cat-vivo">
              <label class="form-check-label" for="cat-vivo">Vivo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input category-filter" type="checkbox" value="realme" id="cat-realme">
              <label class="form-check-label" for="cat-realme">Realme</label>
            </div>
          </div>
        </div>
        
        <!-- Lọc theo giá -->
        <div class="filter-group">
          <h6 class="filter-group-title">Mức giá</h6>
          <div class="filter-options">
            <div class="form-check">
              <input class="form-check-input price-filter" type="radio" name="price" value="" id="price-all" checked>
              <label class="form-check-label" for="price-all">Tất cả</label>
            </div>
            <div class="form-check">
              <input class="form-check-input price-filter" type="radio" name="price" value="under-10" id="price-1">
              <label class="form-check-label" for="price-1">Dưới 10 triệu</label>
            </div>
            <div class="form-check">
              <input class="form-check-input price-filter" type="radio" name="price" value="10-20" id="price-2">
              <label class="form-check-label" for="price-2">10 - 20 triệu</label>
            </div>
            <div class="form-check">
              <input class="form-check-input price-filter" type="radio" name="price" value="20-30" id="price-3">
              <label class="form-check-label" for="price-3">20 - 30 triệu</label>
            </div>
            <div class="form-check">
              <input class="form-check-input price-filter" type="radio" name="price" value="over-30" id="price-4">
              <label class="form-check-label" for="price-4">Trên 30 triệu</label>
            </div>
          </div>
        </div>
        
        <button class="btn btn-primary w-100 mt-3" id="apply-filter">
          <i class="fas fa-check"></i> Áp dụng
        </button>
        <button class="btn btn-outline-secondary w-100 mt-2" id="reset-filter">
          <i class="fas fa-undo"></i> Đặt lại
        </button>
      </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="col-lg-9">
      <!-- Thanh sắp xếp -->
      <div class="sort-bar mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <p class="mb-0 text-muted product-count">Đang tải...</p>
          <div class="d-flex align-items-center gap-2">
            <label class="mb-0">Sắp xếp:</label>
            <select class="form-select form-select-sm" id="sort-select" style="width: auto;">
              <option value="default">Mặc định</option>
              <option value="price-asc">Giá: Thấp → Cao</option>
              <option value="price-desc">Giá: Cao → Thấp</option>
              <option value="name-asc">Tên: A → Z</option>
              <option value="name-desc">Tên: Z → A</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Grid sản phẩm -->
      <div class="row g-4" id="products-grid">
        <!-- Sản phẩm sẽ được load bằng JavaScript -->
        <div class="col-12 text-center py-5">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <p class="mt-2">Đang tải sản phẩm...</p>
        </div>
      </div>

      <!-- Phân trang -->
      <nav class="mt-5" id="pagination-container">
        <!-- Phân trang sẽ được render bằng JavaScript -->
      </nav>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../templates/footer.php'; ?>

<style>
/* Filter Sidebar */
.filter-sidebar {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filter-title {
  font-weight: 600;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #F86338;
}

.filter-group {
  margin-bottom: 20px;
}

.filter-group-title {
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
}

.filter-options .form-check {
  margin-bottom: 8px;
}

.filter-options .form-check-input:checked {
  background-color: #F86338;
  border-color: #F86338;
}

/* Sort Bar */
.sort-bar {
  background: #fff;
  border-radius: 10px;
  padding: 15px 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Product Card */
.product-card {
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
  height: 100%;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.product-card .product-image {
  position: relative;
  padding-top: 100%;
  overflow: hidden;
}

.product-card .product-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
  transform: scale(1.05);
}

.product-card .product-info {
  padding: 15px;
}

.product-card .product-title {
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 10px;
  height: 40px;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.product-card .product-price {
  font-size: 16px;
  font-weight: 700;
  color: #F86338;
}

.product-card .btn-add-cart {
  width: 100%;
  margin-top: 10px;
  background-color: #F86338;
  border-color: #F86338;
}

.product-card .btn-add-cart:hover {
  background-color: #e55327;
  border-color: #e55327;
}

/* Shop Header */
.shop-header {
  background: linear-gradient(135deg, #F86338 0%, #ff8c5a 100%);
  padding: 30px;
  border-radius: 10px;
  color: white;
}

.shop-header .shop-title {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 10px;
}

.shop-header .breadcrumb {
  margin-bottom: 0;
}

.shop-header .breadcrumb-item a {
  color: rgba(255,255,255,0.8);
}

.shop-header .breadcrumb-item.active {
  color: white;
}

/* Pagination */
.pagination .page-link {
  color: #F86338;
  border-color: #dee2e6;
}

.pagination .page-item.active .page-link {
  background-color: #F86338;
  border-color: #F86338;
}

.pagination .page-link:hover {
  color: #e55327;
  background-color: #fff5f2;
}
</style>

<script>
const BASE_URL = '<?= $base_url ?>';
let allProducts = [];
let filteredProducts = [];
let currentPage = 1;
const itemsPerPage = 12;

// Load sản phẩm từ API
async function loadProducts() {
  try {
    const response = await fetch(BASE_URL + 'api/products_api.php');
    allProducts = await response.json();
    filteredProducts = [...allProducts];
    applyFilters();
    renderProducts();
  } catch (error) {
    console.error('Error loading products:', error);
    document.getElementById('products-grid').innerHTML = `
      <div class="col-12 text-center py-5">
        <i class="fas fa-exclamation-circle fa-3x text-danger mb-3"></i>
        <p>Không thể tải sản phẩm. Vui lòng thử lại sau.</p>
      </div>
    `;
  }
}

// Áp dụng bộ lọc
function applyFilters() {
  // Lấy các category được chọn
  const selectedCategories = [];
  document.querySelectorAll('.category-filter:checked').forEach(cb => {
    selectedCategories.push(cb.value.toLowerCase());
  });

  // Lấy mức giá được chọn
  const selectedPrice = document.querySelector('.price-filter:checked')?.value || '';

  // Lọc sản phẩm
  filteredProducts = allProducts.filter(product => {
    // Lọc theo category
    if (selectedCategories.length > 0) {
      const productName = product.title.toLowerCase();
      const matchCategory = selectedCategories.some(cat => productName.includes(cat));
      if (!matchCategory) return false;
    }

    // Lọc theo giá
    if (selectedPrice) {
      const price = product.price;
      switch (selectedPrice) {
        case 'under-10':
          if (price >= 10000000) return false;
          break;
        case '10-20':
          if (price < 10000000 || price >= 20000000) return false;
          break;
        case '20-30':
          if (price < 20000000 || price >= 30000000) return false;
          break;
        case 'over-30':
          if (price < 30000000) return false;
          break;
      }
    }

    return true;
  });

  // Sắp xếp
  const sortValue = document.getElementById('sort-select').value;
  sortProducts(sortValue);

  currentPage = 1;
  renderProducts();
}

// Sắp xếp sản phẩm
function sortProducts(sortBy) {
  switch (sortBy) {
    case 'price-asc':
      filteredProducts.sort((a, b) => a.price - b.price);
      break;
    case 'price-desc':
      filteredProducts.sort((a, b) => b.price - a.price);
      break;
    case 'name-asc':
      filteredProducts.sort((a, b) => a.title.localeCompare(b.title));
      break;
    case 'name-desc':
      filteredProducts.sort((a, b) => b.title.localeCompare(a.title));
      break;
    default:
      // Giữ nguyên thứ tự gốc
      break;
  }
}

// Render sản phẩm
function renderProducts() {
  const grid = document.getElementById('products-grid');
  const start = (currentPage - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  const pageProducts = filteredProducts.slice(start, end);

  // Cập nhật số lượng sản phẩm
  document.querySelector('.product-count').textContent = `Hiển thị ${pageProducts.length} / ${filteredProducts.length} sản phẩm`;

  if (pageProducts.length === 0) {
    grid.innerHTML = `
      <div class="col-12 text-center py-5">
        <i class="fas fa-search fa-3x text-muted mb-3"></i>
        <p>Không tìm thấy sản phẩm phù hợp</p>
      </div>
    `;
    document.getElementById('pagination-container').innerHTML = '';
    return;
  }

  grid.innerHTML = pageProducts.map(product => `
    <div class="col-6 col-md-4 col-lg-4">
      <div class="product-card">
        <a href="${BASE_URL}pages/product_detail.php?id=${product.id}" class="product-image">
          <img src="${BASE_URL}${product.image}" alt="${product.title}">
        </a>
        <div class="product-info">
          <a href="${BASE_URL}pages/product_detail.php?id=${product.id}" class="product-title">${product.title}</a>
          <p class="product-price">${formatPrice(product.price)} đ</p>
          <button class="btn btn-primary btn-add-cart" onclick="addToCart(${product.id})">
            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
          </button>
        </div>
      </div>
    </div>
  `).join('');

  renderPagination();
}

// Render phân trang
function renderPagination() {
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
  if (totalPages <= 1) {
    document.getElementById('pagination-container').innerHTML = '';
    return;
  }

  let html = '<ul class="pagination justify-content-center">';
  
  // Nút Previous
  html += `
    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
      <a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">
        <i class="fas fa-chevron-left"></i>
      </a>
    </li>
  `;

  // Các trang
  for (let i = 1; i <= totalPages; i++) {
    if (i === 1 || i === totalPages || (i >= currentPage - 2 && i <= currentPage + 2)) {
      html += `
        <li class="page-item ${currentPage === i ? 'active' : ''}">
          <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
        </li>
      `;
    } else if (i === currentPage - 3 || i === currentPage + 3) {
      html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }
  }

  // Nút Next
  html += `
    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
      <a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">
        <i class="fas fa-chevron-right"></i>
      </a>
    </li>
  `;

  html += '</ul>';
  document.getElementById('pagination-container').innerHTML = html;
}

// Chuyển trang
function goToPage(page) {
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
  if (page < 1 || page > totalPages) return;
  currentPage = page;
  renderProducts();
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Format giá tiền
function formatPrice(price) {
  return new Intl.NumberFormat('vi-VN').format(price);
}

// Thêm vào giỏ hàng
async function addToCart(productId) {
  <?php if (!$isLoggedIn): ?>
  window.location.href = BASE_URL + 'auth/login.php';
  return;
  <?php endif; ?>

  try {
    const response = await fetch(BASE_URL + 'cart/add_to_cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ productId: productId })
    });

    const data = await response.json();

    if (response.ok) {
      alert('Đã thêm sản phẩm vào giỏ hàng!');
    } else {
      alert(data.error || 'Có lỗi xảy ra');
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
  }
}

// Event Listeners
document.getElementById('apply-filter').addEventListener('click', applyFilters);

document.getElementById('reset-filter').addEventListener('click', () => {
  document.querySelectorAll('.category-filter').forEach(cb => cb.checked = false);
  document.querySelector('.price-filter[value=""]').checked = true;
  document.getElementById('sort-select').value = 'default';
  filteredProducts = [...allProducts];
  currentPage = 1;
  renderProducts();
});

document.getElementById('sort-select').addEventListener('change', (e) => {
  sortProducts(e.target.value);
  renderProducts();
});

// Load sản phẩm khi trang tải
document.addEventListener('DOMContentLoaded', loadProducts);
</script>
