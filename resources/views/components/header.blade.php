<header class="header">
    <div class="container">
        <div class="content">
            <div class="title">
                <p class="m-0"><a href="{{ route('dashboard') }}">প্রগতি ক্ষুদ্র ব্যবসায়ী সমবায় সমিতি লিঃ</a></p>
            </div>
            <div class="reg">
                <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
                    @csrf
                    <p class="m-0">রেজিঃ নং - ২০০০২</p>
                    <button class="btn bg-danger text-white btn-sm ms-2">লগ আউট</button>
                </form>
            </div>
        </div>
    </div>
</header>