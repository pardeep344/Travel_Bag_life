<div class="footer-content">
    <div class="footer-context">
        
        <div class="div-for-context">
            <div class="footer-logo-img"><a href="3"><img src="{{asset('storage/' .$footerSingleton->Image)}}" alt="not found" width="100px" height="100px"></a></div>
            <div class="footer-text">{{$footerSingleton->Text}}</div>
        </div>
        <div class="div-for-context">
            <ul>
                @foreach($Footerlinks as $link)
                    @if($link->Status === 'active')
                        <li><a href="{{ $link->Url }}">{{ $link->Text }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="div-for-context">
            <div class="footer-links">
                @foreach ($socialLinks as $socialLink)
                <div  class="social-icon-style">

                    <a href="{{ $socialLink->Url }}">
                        <img src="{{ asset('storage/' . $socialLink->Image) }}"
                             alt="Social Icon"
                             onerror="this.onerror=null; this.src='{{ asset('images/default-icon.png') }}';">
                    </a>
                </div>
                    
                @endforeach
            </div>
            <div>
                
            </div>
            <div class="search-box">
                <input type="text" placeholder="Enter Here...">
                <button type="submit">Search</button>
              </div>
              
        </div>
    </div>
    <div class="contact-info">
       <div class="bold">Need Help?</div>
       <div class="company-contact"><p>Phone No: {{$footerSingleton->TelPhone}}</p></div>
       <div class="company-contact"><p>Tel No: {{$footerSingleton->Phone}}</p></div>
       <div class="company-contact"><p>Email: {{$footerSingleton->Email}}</p></div> 
    </div>
    <div class="copyright-div">{{$footerSingleton->Copyright}}</div>
</div>