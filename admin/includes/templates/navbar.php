<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">-->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">-->
<!--<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">-->
<!---->
<!--<style>-->
<!--    :root {-->
<!--        --bg: #0b0f19;-->
<!--        --accent: #00e68a;-->
<!--        --text: #e0e4ea;-->
<!--        --muted: #5e6a7e;-->
<!--        --card: #131a2b;-->
<!--        --border: rgba(255, 255, 255, 0.06);-->
<!--    }-->
<!---->
<!--    * {-->
<!--        font-family: 'Tajawal', sans-serif;-->
<!--    }-->
<!---->
<!--    .navbar-dark-custom {-->
<!--        background: var(--bg);-->
<!--        border-bottom: 1px solid var(--border);-->
<!--        /*padding: .65rem 0;*/-->
<!--        transition: padding .3s, box-shadow .3s;-->
<!--    }-->
<!---->
<!--    .navbar-dark-custom.scrolled {-->
<!--        padding: .4rem 0;-->
<!--        box-shadow: 0 4px 40px rgba(0, 230, 138, .04);-->
<!--    }-->
<!---->
<!--    .brand-logo {-->
<!--        width: 36px;-->
<!--        height: 36px;-->
<!--        background: linear-gradient(135deg, var(--accent), #00b8d4);-->
<!--        border-radius: 9px;-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        justify-content: center;-->
<!--        color: var(--bg);-->
<!--        font-weight: 900;-->
<!--        font-size: 1rem;-->
<!--        transition: transform .3s;-->
<!--    }-->
<!---->
<!--    .brand-logo:hover {-->
<!--        transform: rotate(-6deg) scale(1.06);-->
<!--    }-->
<!---->
<!--    .nav-link-c {-->
<!--        color: var(--muted) !important;-->
<!--        font-weight: 600;-->
<!--        font-size: .92rem;-->
<!--        padding: .5rem .9rem !important;-->
<!--        border-radius: 8px;-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        gap: .35rem;-->
<!--        position: relative;-->
<!--        transition: .25s;-->
<!--    }-->
<!---->
<!--    .nav-link-c::after {-->
<!--        content: '';-->
<!--        position: absolute;-->
<!--        bottom: 2px;-->
<!--        right: 50%;-->
<!--        transform: translateX(50%);-->
<!--        width: 0;-->
<!--        height: 2px;-->
<!--        background: var(--accent);-->
<!--        border-radius: 2px;-->
<!--        transition: width .25s;-->
<!--    }-->
<!---->
<!--    .nav-link-c:hover, .nav-link-c.active {-->
<!--        color: var(--text) !important;-->
<!--        background: rgba(0, 230, 138, .06);-->
<!--    }-->
<!---->
<!--    .nav-link-c:hover::after, .nav-link-c.active::after {-->
<!--        width: 45%;-->
<!--    }-->
<!---->
<!--    .nav-link-c.active {-->
<!--        color: var(--accent) !important;-->
<!--    }-->
<!---->
<!--    /* Dropdown */-->
<!--    .dd-toggle {-->
<!--        color: var(--muted) !important;-->
<!--        font-weight: 600;-->
<!--        font-size: .92rem;-->
<!--        padding: .5rem .9rem !important;-->
<!--        border-radius: 8px;-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        gap: .35rem;-->
<!--        transition: .25s;-->
<!--    }-->
<!---->
<!--    .dd-toggle::after {-->
<!--        display: none !important;-->
<!--    }-->
<!---->
<!--    .dd-toggle:hover {-->
<!--        color: var(--text) !important;-->
<!--        background: rgba(0, 230, 138, .06);-->
<!--    }-->
<!---->
<!--    .dd-arrow {-->
<!--        font-size: .65rem;-->
<!--        transition: transform .3s;-->
<!--    }-->
<!---->
<!--    .dropdown.show .dd-arrow {-->
<!--        transform: rotate(180deg);-->
<!--    }-->
<!---->
<!--    .dropdown.show .dd-toggle {-->
<!--        color: var(--accent) !important;-->
<!--    }-->
<!---->
<!--    .dd-menu {-->
<!--        background: var(--card);-->
<!--        border: 1px solid var(--border);-->
<!--        border-radius: 12px;-->
<!--        padding: .45rem;-->
<!--        min-width: 230px;-->
<!--        box-shadow: 0 16px 50px rgba(0, 0, 0, .45);-->
<!--        animation: ddIn .3s ease forwards;-->
<!--        opacity: 0;-->
<!--        transform: translateY(-6px);-->
<!--    }-->
<!---->
<!--    @keyframes ddIn {-->
<!--        to {-->
<!--            opacity: 1;-->
<!--            transform: translateY(0);-->
<!--        }-->
<!--    }-->
<!---->
<!--    .dd-menu[data-bs-popper] {-->
<!--        left: auto !important;-->
<!--        right: 0 !important;-->
<!--    }-->
<!---->
<!--    .dd-item {-->
<!--        color: var(--muted);-->
<!--        font-weight: 500;-->
<!--        font-size: .88rem;-->
<!--        padding: .55rem .85rem;-->
<!--        border-radius: 9px;-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        gap: .6rem;-->
<!--        transition: .2s;-->
<!--    }-->
<!---->
<!--    .dd-item:hover {-->
<!--        background: rgba(0, 230, 138, .07);-->
<!--        color: var(--text);-->
<!--        padding-right: 1.1rem;-->
<!--    }-->
<!---->
<!--    .dd-item .ic {-->
<!--        width: 32px;-->
<!--        height: 32px;-->
<!--        border-radius: 7px;-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        justify-content: center;-->
<!--        font-size: .9rem;-->
<!--        flex-shrink: 0;-->
<!--    }-->
<!---->
<!--    .ic-g {-->
<!--        background: rgba(0, 230, 138, .1);-->
<!--        color: var(--accent);-->
<!--    }-->
<!---->
<!--    .ic-b {-->
<!--        background: rgba(56, 189, 248, .1);-->
<!--        color: #38bdf8;-->
<!--    }-->
<!---->
<!--    .ic-o {-->
<!--        background: rgba(251, 146, 60, .1);-->
<!--        color: #fb923c;-->
<!--    }-->
<!---->
<!--    .ic-r {-->
<!--        background: rgba(248, 113, 113, .1);-->
<!--        color: #f87171;-->
<!--    }-->
<!---->
<!--    .ic-p {-->
<!--        background: rgba(167, 139, 250, .1);-->
<!--        color: #a78bfa;-->
<!--    }-->
<!---->
<!--    .dd-divider {-->
<!--        border-top: 1px solid var(--border);-->
<!--        margin: .3rem .5rem;-->
<!--    }-->
<!---->
<!--    .dd-item.danger:hover {-->
<!--        background: rgba(248, 113, 113, .07);-->
<!--        color: #f87171;-->
<!--    }-->
<!---->
<!--    /* بحث */-->
<!--    .search-box {-->
<!--        background: rgba(255, 255, 255, .04);-->
<!--        border: 1px solid var(--border);-->
<!--        border-radius: 9px;-->
<!--        color: var(--text);-->
<!--        padding: .45rem .9rem;-->
<!--        padding-left: 2.2rem;-->
<!--        font-size: .85rem;-->
<!--        width: 180px;-->
<!--        outline: none;-->
<!--        transition: .3s;-->
<!--    }-->
<!---->
<!--    .search-box::placeholder {-->
<!--        color: var(--muted);-->
<!--        opacity: .45;-->
<!--    }-->
<!---->
<!--    .search-box:focus {-->
<!--        border-color: rgba(0, 230, 138, .3);-->
<!--        width: 230px;-->
<!--        box-shadow: 0 0 0 3px rgba(0, 230, 138, .06);-->
<!--    }-->
<!---->
<!--    .search-icon {-->
<!--        position: absolute;-->
<!--        left: .65rem;-->
<!--        background: none;-->
<!--        border: none;-->
<!--        color: var(--muted);-->
<!--        cursor: pointer;-->
<!--    }-->
<!---->
<!--    /* زر إشعار */-->
<!--    .notif-btn {-->
<!--        width: 36px;-->
<!--        height: 36px;-->
<!--        border-radius: 9px;-->
<!--        border: 1px solid var(--border);-->
<!--        background: rgba(255, 255, 255, .04);-->
<!--        color: var(--muted);-->
<!--        display: flex;-->
<!--        align-items: center;-->
<!--        justify-content: center;-->
<!--        cursor: pointer;-->
<!--        position: relative;-->
<!--        transition: .25s;-->
<!--    }-->
<!---->
<!--    .notif-btn:hover {-->
<!--        color: var(--text);-->
<!--        border-color: rgba(0, 230, 138, .2);-->
<!--    }-->
<!---->
<!--    .notif-dot {-->
<!--        position: absolute;-->
<!--        top: 5px;-->
<!--        right: 5px;-->
<!--        width: 7px;-->
<!--        height: 7px;-->
<!--        background: var(--accent);-->
<!--        border-radius: 50%;-->
<!--        border: 2px solid var(--bg);-->
<!--        animation: pulse 2s infinite;-->
<!--    }-->
<!---->
<!--    @keyframes pulse {-->
<!--        50% {-->
<!--            box-shadow: 0 0 0 4px transparent;-->
<!--        }-->
<!--    }-->
<!---->
<!--    /* toggler جوال */-->
<!--    .toggler-c {-->
<!--        width: 38px;-->
<!--        height: 38px;-->
<!--        border-radius: 9px;-->
<!--        border: 1px solid var(--border);-->
<!--        background: rgba(255, 255, 255, .04);-->
<!--        display: flex;-->
<!--        flex-direction: column;-->
<!--        align-items: center;-->
<!--        justify-content: center;-->
<!--        gap: 4px;-->
<!--        cursor: pointer;-->
<!--        transition: .3s;-->
<!--    }-->
<!---->
<!--    .toggler-c:hover {-->
<!--        border-color: rgba(0, 230, 138, .3);-->
<!--    }-->
<!---->
<!--    .tog-line {-->
<!--        width: 16px;-->
<!--        height: 2px;-->
<!--        background: var(--muted);-->
<!--        border-radius: 2px;-->
<!--        transition: .3s;-->
<!--    }-->
<!---->
<!--    .toggler-c[aria-expanded="true"] .tog-line:nth-child(1) {-->
<!--        transform: translateY(6px) rotate(45deg);-->
<!--        background: var(--accent);-->
<!--    }-->
<!---->
<!--    .toggler-c[aria-expanded="true"] .tog-line:nth-child(2) {-->
<!--        opacity: 0;-->
<!--    }-->
<!---->
<!--    .toggler-c[aria-expanded="true"] .tog-line:nth-child(3) {-->
<!--        transform: translateY(-6px) rotate(-45deg);-->
<!--        background: var(--accent);-->
<!--    }-->
<!---->
<!--    @media (max-width: 991px) {-->
<!--        .collapse-c {-->
<!--            background: var(--card);-->
<!--            border-radius: 12px;-->
<!--            margin-top: .6rem;-->
<!--            padding: .8rem;-->
<!--            border: 1px solid var(--border);-->
<!--        }-->
<!---->
<!--        .search-box, .search-box:focus {-->
<!--            width: 100% !important;-->
<!--        }-->
<!---->
<!--        .desk-only {-->
<!--            display: none !important;-->
<!--        }-->
<!--    }-->
<!--</style>-->
<!---->
<!--<nav class="navbar navbar-expand-lg navbar-dark-custom" id="nav">-->
<!--    <div class="container-fluid px-3">-->
<!--        <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="#"-->
<!--           style="color:var(--text);font-weight:900;font-size:1.3rem;">-->
<!--            <span class="brand-logo"><i class="bi bi-lightning-charge-fill"></i></span>-->
<!--            AL-NABEEL TECHNOLOGY-->
<!--        </a>-->
<!---->
<!--        <button class="toggler-c d-lg-none" data-bs-toggle="collapse" data-bs-target="#navC" aria-expanded="false"-->
<!--                aria-label="القائمة">-->
<!--            <span class="tog-line"></span><span class="tog-line"></span><span class="tog-line"></span>-->
<!--        </button>-->
<!---->
<!--        <div class="collapse navbar-collapse collapse-c" id="navC">-->
<!--            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1 mt-2 mt-lg-0">-->
<!--                <li class="nav-item"><a class="nav-link nav-link-c active" href="index.php"><i class="bi bi-house-fill"></i>-->
<!--                        الرئيسية</a></li>-->
<!--                <li class="nav-item"><a class="nav-link nav-link-c" href="items.php?do=manage"><i class="bi bi-bar-chart-line-fill"></i>-->
<!--                        Items</a></li>-->
<!--                <li class="nav-item"><a class="nav-link nav-link-c" href="categories.php?do=manage"><i class="bi bi-box-seam-fill"></i> categories </a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link nav-link-c" href="comments.php?do=manage">-->
<!--                        <i class="bi bi-chat-left-quote-fill"></i> comments-->
<!--                    </a>-->
<!--                </li>-->
<!---->
<!---->
<!--                <li class="nav-item"><a class="nav-link nav-link-c" href="members.php?do=manage"><i-->
<!--                                class="bi bi-people-fill"></i> Members</a></li>-->
<!---->
<!--                <li class="nav-item dropdown">-->
<!--                    <a class="nav-link dd-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                        <i class="bi bi-person-circle"></i> حسابي <i class="bi bi-chevron-down dd-arrow"></i>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu dd-menu">-->
<!--                        <li class="px-3 py-2 d-flex align-items-center gap-2"-->
<!--                            <img src="https://picsum.photos/seed/u7/80/80.jpg"-->
<!--                                 style="width:34px;height:34px;border-radius:8px;object-fit:cover;" alt="">-->
<!--                            <div>-->
<!--                                <div style="font-size:.85rem;font-weight:700;color:var(--text)">user</div>-->
<!--                                <div style="font-size:.7rem;color:var(--muted)">ahmed@mail.com</div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <hr class="dd-divider">-->
<!--                        </li>-->
<!--                        <li><a class="dropdown-item dd-item"-->
<!--                               href="../../members.php?do=edit&userID=--><?php //echo $_SESSION['userID'] ?><!--">-->
<!--                                <span class="ic ic-g"><i class="bi bi-person-gear"></i></span> تعديل الملف الشخصي</a>-->
<!--                        </li>-->
<!--                        <li><a class="dropdown-item dd-item" href="../../members.php?do=manage"><span class="ic ic-b"><i-->
<!--                                            class="bi bi-gear" >-->
<!---->
<!--                                    </i></span> الإعدادات</a></li>-->
<!--                        <li><a class="dropdown-item dd-item" href="#"><span class="ic ic-p"><i-->
<!--                                            class="bi bi-shield-check"></i></span> الأمان والخصوصية</a></li>-->
<!--                        <li><a class="dropdown-item dd-item" href="#"><span class="ic ic-o"><i-->
<!--                                            class="bi bi-moon-stars"></i></span> الوضع الليلي</a></li>-->
<!--                        <li>-->
<!--                            <hr class="dd-divider">-->
<!--                        </li>-->
<!--                        <li><a class="dropdown-item dd-item danger" href="../../logout.php"><span class="ic ic-r"><i-->
<!--                                            class="bi bi-box-arrow-left"></i></span> تسجيل الخروج</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!---->
<!--            <div class="d-flex align-items-center gap-2 desk-only">-->
<!--                <div class="position-relative">-->
<!--                    <input class="search-box" type="search" placeholder="ابحث..." aria-label="بحث">-->
<!--                    <button class="search-icon" aria-label="بحث"><i class="bi bi-search"></i></button>-->
<!--                </div>-->
<!--                <button class="notif-btn" id="nBtn"><i class="bi bi-bell"></i><span class="notif-dot"></span></button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<!---->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->
<!--<script>-->
<!--    const nav = document.getElementById('nav');-->
<!--    window.addEventListener('scroll', () => nav.classList.toggle('scrolled', scrollY > 30));-->
<!---->
<!--    document.getElementById('nBtn')?.addEventListener('click', function () {-->
<!--        const d = this.querySelector('.notif-dot');-->
<!--        if (d) {-->
<!--            d.style.opacity = '0';-->
<!--            d.style.transform = 'scale(0)';-->
<!--            setTimeout(() => d.remove(), 300);-->
<!--        }-->
<!--    });-->
<!--</script>-->
