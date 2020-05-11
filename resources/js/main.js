
localStorage.setItem('sidebar', 'hidden');
localStorage.setItem('mobileNavContent', 'hidden');
localStorage.setItem('mobileNavBlog', 'hidden');

// =================================
// Toggle sidebar on mobiles and tablets
// =================================

const mobileNavsBtn = document.getElementById('burgerBtn1');

if (mobileNavsBtn) {
  mobileNavsBtn.addEventListener('click', toggleMobileNav);
}

function toggleMobileNav() {

  // get main nav status
  let sidebarStatus = localStorage.getItem('sidebar');

  if (sidebarStatus === 'hidden') {
    // show main nav
    showMobileNav();
    localStorage.setItem('sidebar', 'opened');
  } else if (sidebarStatus === 'opened') {
    // hide main nav
    hideMobileNav();
    localStorage.setItem('sidebar', 'hidden');

    // hide website content subpages in nav
    hideNavContent();
    localStorage.setItem('mobileNavContent', 'hidden');

    // hide blog subpages in nav
    hideNavBlog();
    localStorage.setItem('mobileNavBlog', 'hidden');
  }
}

const sidebarWrapper = document.querySelector('.sidebar-wrapper');

// show main nav function
function showMobileNav() {
  sidebarWrapper.classList.add('toggle-sidebar-wrapper');
}

// hide main nav function
function hideMobileNav() {
  sidebarWrapper.classList.remove('toggle-sidebar-wrapper');
}


// =================================
// Toggle sidebar on laptops and notebooks
// =================================

const laptopNavsBtn = document.getElementById('burgerBtn2');

if (laptopNavsBtn) {
  laptopNavsBtn.addEventListener('click', toggleLaptopNav);
}

function toggleLaptopNav() {

  // get main nav status
  let sidebarStatus = localStorage.getItem('sidebar');

  if (sidebarStatus === 'hidden') {
    // show main nav
    showLaptopNav();
    localStorage.setItem('sidebar', 'opened');
  } else if (sidebarStatus === 'opened') {
    // hide main nav
    hideLaptopNav();
    localStorage.setItem('sidebar', 'hidden');

    // hide website content subpages in nav
    hideNavContent();
    localStorage.setItem('mobileNavContent', 'hidden');

    // hide blog subpages in nav
    hideNavBlog();
    localStorage.setItem('mobileNavBlog', 'hidden');
  }
}

// const sidebarWrapper = document.querySelector('.sidebar-wrapper');
let sidebarListNames = document.querySelectorAll('.sidebar-list-name');
let sidebarListLinks = document.querySelectorAll('.sidebar-list-link');
const sidebarFooter = document.querySelector('.sidebar-footer');

// show main nav function
function showLaptopNav() {
  sidebarWrapper.classList.add('toggle-sidebar-wrapper');

  sidebarListNames.forEach(name => {
    name.classList.add('toggle-sidebar-list-name');
  });

  sidebarListLinks.forEach(link => {
    link.classList.add('toggle-sidebar-links');
  });

  sidebarFooter.classList.add('toggle-sidebar-footer');
}

// hide main nav function
function hideLaptopNav() {
  sidebarWrapper.classList.remove('toggle-sidebar-wrapper');

  sidebarListNames.forEach(name => {
    name.classList.remove('toggle-sidebar-list-name');
  });

  sidebarListLinks.forEach(link => {
    link.classList.remove('toggle-sidebar-links');
  });

  sidebarFooter.classList.remove('toggle-sidebar-footer');
}


// =================================
// Toggle sidebar content subpages
// =================================

const websiteContentBtn = document.getElementById('websiteContentBtn');

if (websiteContentBtn) {
  websiteContentBtn.addEventListener('click', toggleNavContent);
}

function toggleNavContent(e) {

  e.preventDefault();

  // get website content nav status
  let navContentStatus = localStorage.getItem('mobileNavContent');

  if (navContentStatus === 'hidden') {
    // show main nav
    showLaptopNav();
    localStorage.setItem('sidebar', 'opened');
    // show website content subpages
    showNavContent();
    localStorage.setItem('mobileNavContent', 'opened');
  } else if (navContentStatus === 'opened') {
    // hide website content subpages
    hideNavContent();
    localStorage.setItem('mobileNavContent', 'hidden');
  }
}

let contentList = document.querySelectorAll('.content-subpages');

// show website content subpages function
function showNavContent() {
  contentList.forEach(item => {
    item.classList.add('toggle-content-subpages');
  });
}

// hide website content subpages function
function hideNavContent() {
  contentList.forEach(item => {
    item.classList.remove('toggle-content-subpages');
  });
}


// =================================
// Toggle sidebar blog subpages
// =================================

const blogtBtn = document.getElementById('blogBtn');

if (blogtBtn) {
  blogtBtn.addEventListener('click', toggleNavBlog);
}

function toggleNavBlog(e) {

  e.preventDefault();

  // get blog nav status
  let navBlogStatus = localStorage.getItem('mobileNavBlog');

  if (navBlogStatus === 'hidden') {
    // show main nav
    showLaptopNav();
    localStorage.setItem('sidebar', 'opened');
    // show blog subpages
    showNavBlog();
    localStorage.setItem('mobileNavBlog', 'opened');
  } else if (navBlogStatus === 'opened') {
    // hide blog subpages
    hideNavBlog();
    localStorage.setItem('mobileNavBlog', 'hidden');
  }
}

let blogList = document.querySelectorAll('.blog-subpages');

// show blog subpages function
function showNavBlog() {
  blogList.forEach(item => {
    item.classList.add('toggle-blog-subpages');
  });
}

// hide blog subpages function
function hideNavBlog() {
  blogList.forEach(item => {
    item.classList.remove('toggle-blog-subpages');
  });
}


// =================================
// Close alert
// =================================

const closeAlertBtn = document.getElementById('closeAlertBtn');
const alertWrapper = document.getElementById('alert');

function hideAlert() {
  const alert = document.getElementById('alert');
  alert.classList.add('hideAlert');
}

function autoHideAlert() {
  setTimeout(hideAlert, 11000);
}

if (closeAlertBtn) {
  closeAlertBtn.addEventListener('click', hideAlert);
  autoHideAlert();
}

if (alertWrapper) {
  alertWrapper.addEventListener('click', hideAlert);
  autoHideAlert();
}


// =================================
// Update Profile
// =================================

localStorage.setItem('activeTab', 'profileInfo');
let activeTab = localStorage.getItem('activeTab');
// console.log('Status: ', activeTab);

// Update Profile Information
const updateProfileInfoBtn = document.getElementById('updateProfileInfoBtn');

if (updateProfileInfoBtn) {
  updateProfileInfoBtn.addEventListener('click', toggleProfileInfo);
}

function toggleProfileInfo() {
  updateProfilePassBtn.classList.remove('active');
  updateProfileInfoBtn.classList.add('active');

  localStorage.setItem('activeTab', 'profileInfo');
  let activeTab = localStorage.getItem('activeTab');
  // console.log('Status: ', activeTab);

  showProfileInfo();
  hideProfilePass();
}

const updateProfileInfo = document.getElementById('updateProfileInfo');

function showProfileInfo() {
  updateProfileInfo.classList.remove('content-hidden');
}

function hideProfileInfo() {
  updateProfileInfo.classList.add('content-hidden');
}

// Update Profile Password
const updateProfilePassBtn = document.getElementById('updateProfilePassBtn');

if (updateProfilePassBtn) {
  updateProfilePassBtn.addEventListener('click', toggleProfilePass);
}

function toggleProfilePass() {
  updateProfileInfoBtn.classList.remove('active');
  updateProfilePassBtn.classList.add('active');

  localStorage.setItem('activeTab', 'profilePass');
  let activeTab = localStorage.getItem('activeTab');
  // console.log('Status: ', activeTab);

  showProfilePass();
  hideProfileInfo();
}

const updateProfilePass = document.getElementById('updateProfilePass');

function showProfilePass() {
  updateProfilePass.classList.remove('content-hidden');
}

function hideProfilePass() {
  updateProfilePass.classList.add('content-hidden');
}


// =================================
// jQuery code
// =================================

$(document).ready(function () {

  // =================================
  // Uploaded post image prev (create blog post)
  // =================================

  $('#uploadedPostImage').change(function () {
    var reader = new FileReader();
    reader.onload = (e) => {
      $('#uploadedPostImagePreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });

  $("#uploadedPostImage").change(function () {
    readURL(this);
  });


  // =================================
  // Uploaded post image prev (edit blog post)
  // =================================

  $('#editedPostImage').change(function () {
    var reader = new FileReader();
    reader.onload = (e) => {
      $('#editedPostImagePreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });

  $("#editedPostImage").change(function () {
    readURL(this);
  });


  // =================================
  // Uploaded banner image prev (create banner)
  // =================================

  $('#uploadedBannerImage').change(function () {
    var reader = new FileReader();
    reader.onload = (e) => {
      $('#uploadedBannerImagePreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });

  $("#uploadedBannerImage").change(function () {
    readURL(this);
  });


  // =================================
  // Uploaded banner image prev (edit banner)
  // =================================

  $('#editedBannerImage').change(function () {
    var reader = new FileReader();
    reader.onload = (e) => {
      $('#editedBannerImagePreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });

  $("#editedBannerImage").change(function () {
    readURL(this);
  });

});


// =================================
// Login form tooltips: copy/change text
// =================================

const mailBtn = document.getElementById('mailBtn');

if (mailBtn) {
  mailBtn.addEventListener('click', () => {
    document.execCommand("copy");
  });

  mailBtn.addEventListener("copy", (event) => {
    event.preventDefault();
    if (event.clipboardData) {
      event.clipboardData.setData("text/plain", 'admin@mail.com');
      let mailTooltipText = document.querySelector('.mailTooltipText');
      mailTooltipText.innerHTML = 'Copied!'
    }
  });

  mailBtn.addEventListener('mouseleave', () => {
    let mailTooltipText = document.querySelector('.mailTooltipText');
    mailTooltipText.innerHTML = 'Copy'
  });
}

// --------------

const passBtn = document.getElementById('passBtn');

if (passBtn) {
  passBtn.addEventListener('click', () => {
    document.execCommand("copy");
  });

  passBtn.addEventListener("copy", function (event) {
    event.preventDefault();
    if (event.clipboardData) {
      event.clipboardData.setData("text/plain", 'pass');
      let passTooltipText = document.querySelector('.passTooltipText');
      passTooltipText.innerHTML = 'Copied!'
    }
  });

  passBtn.addEventListener('mouseleave', () => {
    let passTooltipText = document.querySelector('.passTooltipText');
    passTooltipText.innerHTML = 'Copy'
  });
}
