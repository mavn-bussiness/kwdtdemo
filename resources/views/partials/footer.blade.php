<footer class="kwdt-footer">
    <div class="footer-top">

        <div class="footer-brand">
            <span class="footer-acronym">KWDT</span>
            <p class="footer-tagline">
                Katosi Women Development Trust is a registered non-profit organisation
                dedicated to improving the living standards of poor and rural fisher
                communities in Uganda.
            </p>
            <p class="footer-reg">Reg. No. S.5914/6911 — NGO Bureau Uganda</p>

            {{-- Newsletter signup embedded in footer --}}
            <div class="footer-newsletter">
                <p class="newsletter-label">Stay updated</p>
                @livewire('newsletter-signup', ['compact' => true])
            </div>
        </div>

        <div class="footer-col">
            <h4>Organisation</h4>
            <ul>
                <li><a href="{{ route('about.index') }}">History & Mission</a></li>
                <li><a href="{{ route('about.what-we-do') }}">What We Do</a></li>
                <li><a href="{{ route('about.index') }}">Meet the Team</a></li>
                <li><a href="{{ route('about.index') }}">Our Partners</a></li>
                <li><a href="{{ route('awards') }}">Awards & Recognition</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Resources</h4>
            <ul>
                <li><a href="{{ route('blog.index') }}">Blog & News</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('reports') }}">Annual Reports</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Get Involved</h4>
            <ul>
                <li><a href="{{ route('donate') }}">Donate</a></li>
                <li><a href="{{ route('careers') }}">Careers</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>

            <h4 class="mt-6">Follow Us</h4>
            <ul>
                <li><a href="https://www.instagram.com/kwdt_uganda" target="_blank" rel="noopener">Instagram</a></li>
                <li><a href="https://www.facebook.com/kwdt" target="_blank" rel="noopener">Facebook</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Katosi Women Development Trust. All rights reserved.</p>
        <div class="footer-legal">
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <span>·</span>
            <a href="{{ route('terms') }}">Terms of Service</a>
        </div>
    </div>
</footer>
