<?php
// @codingStandardsIgnoreStart

namespace PastaMedia;

class Logger {

    private $plugin_name;
    private $upload_dir;
    private $plugin_dir;
    private $log_filename;

    function __construct(string $plugin_name)
    {
        $this->plugin_name = strtolower(str_replace(' ', '-', $plugin_name));
        $this->upload_dir = wp_upload_dir();
        $this->log_filename = date('Y-m-d') . '.log';
         
        // Tworzymy folder dla logów jeśli jeszcze nie istnieje
        if ( isset( $this->plugin_name ) && ! empty( $this->upload_dir['basedir'] ) ) {
            $this->plugin_dir = $this->upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'pastamedia-logs'. DIRECTORY_SEPARATOR . $this->plugin_name;
            if ( ! file_exists( $this->plugin_dir ) ) {
                wp_mkdir_p( $this->plugin_dir );
            }
        }
    }

    public function log($title, $data, $append_time = true)
    {
        $time = date('H:i:s');
        if (is_array($data) || is_object($data)) {
            $data = print_r($data, true);
        }

        $output = "$title\r\n$data\r\n";
        if ($append_time) {
            $output = "[$time] $output";
        }

        if (function_exists('mb_convert_encoding')) {
            $output = mb_convert_encoding($output, 'UTF-8');
        } else {
            $output .= ' (UWAGA: Brak funkcji "mb_convert_encoding" może negatywnie wpłynąć na zapisany log)';
        }

        file_put_contents($this->plugin_dir . DIRECTORY_SEPARATOR . $this->log_filename, $output, FILE_APPEND | LOCK_EX);
    }
}
