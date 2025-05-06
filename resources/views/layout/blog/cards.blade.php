<div class="page-title"><span>Blogs </span> On  Places</div>
<div class="blog-card-contai">
  
    @foreach ($blogs as $blog)
    <div class="blog-card">
        <div class="blog-card-img"><a href="#"><img src="{{ asset('storage/' . $blog->image) }}" alt="not found" class="blog_img"></a></div>
        <div class="blog-card-context">
            <div class="blog-parha">{{$blog->description}}</div>
            <div class="blog-date">{{$blog->publishDate}}</div>
            <div class="blog-action"><input type="button" value="view" class="blog-btn"></div>
        </div>
    </div> 
    @endforeach   
</div>