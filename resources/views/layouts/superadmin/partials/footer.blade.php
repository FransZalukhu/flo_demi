<!-- <div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center fw-bold mb-2">
                © Copyright {{ date('Y') }} || Flashsoft Indonesia
            </div>
            <div class="col-12 text-center footer-links">
                <a href="#">About</a>
                <a href="#">Support</a>
                <a href="#">Contact Us</a>
            </div>
        </div>
    </div>
</div> -->
<style>
    .footer-modern {
        padding: 20px 28px;
        border-top: 1px solid var(--border-color);
        background: var(--footer-bg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: background 0.35s ease, border-color 0.35s ease;
    }

    .footer-modern .footer-copy {
        font-size: 12px;
        font-weight: 600;
        color: var(--footer-copy-color);
    }

    .footer-modern .footer-copy span {
        color: var(--brand-purple);
        font-weight: 800;
    }

    .footer-modern .footer-links {
        display: flex;
        gap: 20px;
    }

    .footer-modern .footer-links a {
        font-size: 12px;
        font-weight: 600;
        color: var(--footer-link-color);
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-modern .footer-links a:hover {
        color: var(--brand-purple);
    }
</style>

<footer class="footer-modern">
    <div class="footer-copy">
        © {{ date('Y') }} <span>Flodemi</span> by Flashsoft Indonesia. All rights reserved.
    </div>
    <div class="footer-links">
        <a href="#">About</a>
        <a href="#">Support</a>
        <a href="#">Contact Us</a>
    </div>
</footer>