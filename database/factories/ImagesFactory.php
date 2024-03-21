<?php

namespace Database\Factories;

use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\images>
 */
class ImagesFactory extends Factory {

    // Function to scan a folder for files and return an array of file names
    function scanFolder($folderPath) {
        $files = array(); // Initialize an empty array to store file names

        // Check if the folder exists and is readable
        if (is_dir($folderPath) && is_readable($folderPath)) {
            // Open the directory handle
            if ($handle = opendir($folderPath)) {
                // Loop through each file in the directory
                while (($file = readdir($handle)) !== false) {
                    // Exclude "." and ".." which represent the current and parent directory
                    if ($file != "." && $file != "..") {
                        // Add the file name to the array
                        $files[] = $file;
                    }
                }
                closedir($handle); // Close the directory handle
            } else {
                echo "Error: Unable to open directory.";
            }
        } else {
            echo "Error: Folder {$folderPath} not found or not readable.";
        }

        return $files; // Return the array of file names
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $IMAGE_PATH = base_path('/public/images/store');
        $fileList = $this->scanFolder($IMAGE_PATH);
        $a_image = $IMAGE_PATH . $this->faker->randomElement($fileList);

        return [
            'product_variants_id' => ProductVariants::factory(),
            'next_image' => 0,
            'featured' => false,
            'path' => $a_image
        ];
    }
}
