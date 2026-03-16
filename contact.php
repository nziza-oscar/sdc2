<?php
$page_title = 'Contact';
include 'header.php';
?>

<!-- Contact Hero -->
<section class="relative py-20 bg-gradient-to-br from-teal-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-teal-600 font-semibold tracking-wider uppercase text-sm mb-4 block">Get in Touch</span>
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Let's discuss your <span class="text-teal-600">next project</span></h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Your project deserves a personal touch. We don't just bid; we collaborate. Contact us, and our team will come to you to start our close partnership.
        </p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Contact Info Cards -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Location -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_50px_-20px_rgba(15,118,110,0.15)] transition-all duration-300">
                    <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-regular fa-location-dot text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Our Location</h3>
                    <p class="text-gray-600">M.peace plaza 3rd floor<br>Block B F3 31 room<br>Kigali, Rwanda</p>
                </div>
                
                <!-- Phone -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_50px_-20px_rgba(15,118,110,0.15)] transition-all duration-300">
                    <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-regular fa-phone text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Phone Number</h3>
                    <p class="text-gray-600">+250 785 035 071</p>
                    <p class="text-gray-500 text-sm mt-2">Mon-Fri, 8:00 - 18:00</p>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_50px_-20px_rgba(15,118,110,0.15)] transition-all duration-300">
                    <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa-regular fa-envelope text-2xl text-teal-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email Address</h3>
                    <p class="text-gray-600">info@everdesigngroupe.com</p>
                    <p class="text-gray-600">everdesigncompany@mail.com</p>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                    <h2 class="text-2xl font-bold mb-6">Send us a message</h2>
                    
                    <?php
                    // Form submission handling (without database)
                    $message_sent = false;
                    $errors = [];
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $first_name = trim($_POST['first_name'] ?? '');
                        $last_name = trim($_POST['last_name'] ?? '');
                        $email = trim($_POST['email'] ?? '');
                        $phone = trim($_POST['phone'] ?? '');
                        $subject = trim($_POST['subject'] ?? '');
                        $message = trim($_POST['message'] ?? '');
                        
                        // Basic validation
                        if (empty($first_name)) $errors[] = 'First name is required';
                        if (empty($last_name)) $errors[] = 'Last name is required';
                        if (empty($email)) $errors[] = 'Email is required';
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
                        if (empty($message)) $errors[] = 'Message is required';
                        
                        if (empty($errors)) {
                            // In a real app, you'd send an email here
                            // For now, just show success message
                            $message_sent = true;
                            
                            // Clear form data
                            $_POST = [];
                        }
                    }
                    ?>
                    
                    <?php if ($message_sent): ?>
                        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fa-regular fa-circle-check text-2xl"></i>
                                <div>
                                    <strong class="block">Thank you for contacting us!</strong>
                                    <span>We'll get back to you within 24 hours.</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-6">
                            <ul class="list-disc list-inside">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" 
                                       class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all" 
                                       placeholder="Enter your first name" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" 
                                       class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all" 
                                       placeholder="Enter your last name" required>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" 
                                       class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all" 
                                       placeholder="Enter your email" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" 
                                       class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all" 
                                       placeholder="Enter phone number">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" 
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all" 
                                   placeholder="Enter subject">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-teal-600 focus:ring-2 focus:ring-teal-100 outline-none transition-all resize-none" 
                                      placeholder="Tell us about your project..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>
                        
                        <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-teal-600 text-white font-semibold rounded-full hover:bg-blue-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                            Send Message
                            <i class="fa-regular fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl overflow-hidden shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.475553584627!2d30.0585!3d-1.9441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6b2b1b3c2b7%3A0x123456789abcdef!2sKigali%2C%20Rwanda!5e0!3m2!1sen!2s!4v1234567890" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
                class="w-full">
            </iframe>
        </div>
    </div>
</section>

<!-- Business Hours -->
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Office Hours</h2>
            <p class="text-lg text-gray-600 mb-12">We're here when you need us</p>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                    <div class="text-3xl font-bold text-teal-600 mb-2">Mon-Fri</div>
                    <p class="text-gray-600">8:00 AM - 6:00 PM</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                    <div class="text-3xl font-bold text-teal-600 mb-2">Saturday</div>
                    <p class="text-gray-600">9:00 AM - 2:00 PM</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                    <div class="text-3xl font-bold text-teal-600 mb-2">Sunday</div>
                    <p class="text-gray-600">Closed</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>