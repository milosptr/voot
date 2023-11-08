@if (isset($_COOKIE['order_for_user']))
    <section>
        @php
            $subaccount = App\Models\User::find($_COOKIE['order_for_user']);
        @endphp
        <div class="flex justify-center gap-x-6 bg-gray-900 px-6 py-2.5 sm:px-3.5">
            <div class="text-sm leading-6 text-white text-center">
                <strong class="font-medium">Ath:</strong> Þú ert að nota aðgang fyrir {{ $subaccount->name }}. <span
                    id="subaccount-active" class='text-white cursor-pointer'>Ýttu hér til að skipta til baka
                    &nbsp;<span>&rarr;</span></span>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#subaccount-active').addEventListener('click', function(e) {
                e.preventDefault();
                document.cookie = "order_for_user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.reload();
            });
        });
    </script>
@endif
