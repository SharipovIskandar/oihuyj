<?php


LoadPartials(path: "header", loadFromPublic: false);


?>
    <body class="font-body text-base text-black dark:text-white dark:bg-slate-900">

    <div class="page-wrapper toggled">
        <!-- sidebar-wrapper -->
        <?php loadPartials(path: "sidebar", loadFromPublic: false); ?>
        <!-- sidebar-wrapper  -->

        <!-- Start Page Content -->
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <!-- Top Header -->
            <?php loadPartials(path: "top-header", loadFromPublic: false); ?>
            <!-- Top Header -->

            <div class="container-fluid relative px-3">
                <div class="layout-specing">
                    <!-- Start Content -->


                    <div class="md:flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Explore Properties</h5>

                        <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                            <li class="inline-block capitalize text-[16px] font-medium duration-500 dark:text-white/70 hover:text-green-600 dark:hover:text-white">
                                <a href="index.html">Hously</a></li>
                            <li class="inline-block text-base text-slate-950 dark:text-white/70 mx-0.5 ltr:rotate-0 rtl:rotate-180">
                                <i class="mdi mdi-chevron-right"></i></li>
                            <li class="inline-block capitalize text-[16px] font-medium text-green-600 dark:text-white"
                                aria-current="page">Properties
                            </li>
                        </ul>
                    </div>
                    <!--                        <div class="container relative">-->
                    <div class="page-wrapper toggled">
                        <!-- Start Page Content -->

                        <main class="page-content bg-gray-50 dark:bg-slate-800">
                            <div class="container-fluid relative px-3">
                                <div class="layout-specing">
                                    <!-- Start Content -->

                                    <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                                        <div>
                                            <p class="font-medium mb-4">Upload your property image here, Please click
                                                "Upload
                                                Image" Button.</p>
                                            <div class="preview-box flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small w-auto max-h-60">
                                                Supports JPG, PNG and MP4 videos. Max file size : 10MB.
                                            </div>
                                            <input form="ads-create" type="file" id="input-file" name="image"
                                                   accept="image/*"
                                                   onchange={handleChange()} hidden>
                                            <label class="btn-upload btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-6 cursor-pointer"
                                                   for="input-file">Upload Image</label>
                                        </div>
                                    </div>


                                    <div class="container relative">
                                        <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mt-6">
                                            <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                                                <form id="ads-create" action="/branch/create" method="post"
                                                      enctype="multipart/form-data">
                                                    <div class="grid grid-cols-12 gap-5">
                                                        <div class="col-span-12">
                                                            <label for="title" class="font-medium">Address</label>
                                                            <input name="address" id="title" type="text"
                                                                   class="form-input mt-2"
                                                                   placeholder="Adress">
                                                        </div>
                                                        <div class="col-span-12">
                                                            <label for="title" class="font-medium">Name </label>
                                                            <input name="name" id="title" type="text"
                                                                   class="form-input mt-2"
                                                                   placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <button type="submit" id="submit"
                                                            class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-5">
                                                        Yuborish
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Content -->
                                </div>
                            </div><!--end container-->
                        </main>
                    </div>
                </div> <!-- End Content -->
            </div><!--end container-->
        </main>
    </div>
<?php
loadPartials(path: "footer", loadFromPublic: false);
?>
