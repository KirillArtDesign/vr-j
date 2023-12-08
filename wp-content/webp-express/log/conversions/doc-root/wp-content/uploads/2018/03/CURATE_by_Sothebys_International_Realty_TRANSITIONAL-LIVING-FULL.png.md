WebP Express 0.17.2. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2020-01-26 11:17:10

*WebP Convert 2.3.0*  ignited.
- PHP version: 7.0.33-0+deb9u6
- Server software: Apache/2.4.25 (Debian)

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp
- log-call-arguments: true
- converters: (array of 9 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- alpha-quality: 85
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 85
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp
- alpha-quality: 85
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 85
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- auto-filter: false
- default-quality: 85
- max-quality: 85
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version. Result: *Exec failed* (the cwebp binary was not found at path: cwebp)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 3
Found 3 binaries: 
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -version. Result: version: *1.0.3*
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -version. Result: *Exec failed* (the cwebp binary was not found at path: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static)
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -version. Result: version: *0.6.1*
Binaries ordered by version number.
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64: (version: 1.0.3)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: (version: 0.6.1)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.0.3
Quality: 85. 
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp.lossy.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp.lossy.webp'
File:      [doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png
Dimension: 1024 x 529
Output:    73902 bytes Y-U-V-All-PSNR 41.79 45.87 46.76   42.84 dB
           (1.09 bpp)
block count:  intra4:       1369  (62.91%)
              intra16:       807  (37.09%)
              skipped:       354  (16.27%)
bytes used:  header:            455  (0.6%)
             mode-partition:   7060  (9.6%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |   48547 |    1284 |     543 |     113 |   50487  (68.3%)
 intra16-coeffs:  |    3328 |    1316 |    1014 |     101 |    5759  (7.8%)
  chroma coeffs:  |    9304 |     481 |     270 |      56 |   10111  (13.7%)
    macroblocks:  |      72%|       7%|       7%|      14%|    2176
      quantizer:  |      16 |      12 |       8 |       8 |
   filter level:  |       7 |       9 |       9 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |   61179 |    3081 |    1827 |     270 |   66357  (89.8%)

Success
Reduction: 60% (went from 179 kb to 72 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version. Result: *Exec failed* (the cwebp binary was not found at path: cwebp)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 3
Found 3 binaries: 
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -version. Result: version: *1.0.3*
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -version. Result: *Exec failed* (the cwebp binary was not found at path: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static)
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -version. Result: version: *0.6.1*
Binaries ordered by version number.
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64: (version: 1.0.3)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: (version: 0.6.1)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.0.3
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp.lossless.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png.webp.lossless.webp'
File:      [doc-root]/wp-content/uploads/2018/03/CURATE_by_Sothebys_International_Realty_TRANSITIONAL-LIVING-FULL.png
Dimension: 1024 x 529
Output:    155902 bytes (2.30 bpp)
Lossless-ARGB compressed size: 155902 bytes
  * Header size: 1613 bytes, image data size: 154263
  * Lossless features used: PALETTE
  * Precision Bits: histogram=4 transform=4 cache=3
  * Palette size:   256

Success
Reduction: 15% (went from 179 kb to 152 kb)

Picking lossy
cwebp succeeded :)

Converted image in 793 ms, reducing file size with 60% (went from 179 kb to 72 kb)
