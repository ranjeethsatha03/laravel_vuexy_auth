<div class="form-control" >
<x-app-layout>
    <div class="form-control" style="border: none;">
    <div class="py-12">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="form-control" style="border: none;">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="form-control" style="border: none;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="form-control" style="border: none;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> 
            
        </div>
    </div>
</div>
    
</x-app-layout>
</div>
    