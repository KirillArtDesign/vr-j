WebP Express 0.17.2. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2019-11-14 23:14:14

*WebP Convert 2.3.0*  ignited.
- PHP version: 7.0.33-0+deb9u6
- Server software: Apache/2.4.25 (Debian)

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp
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
- source: [doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp
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
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 85 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp.lossy.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp.lossy.webp'
File:      [doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png
Dimension: 400 x 250
Output:    12716 bytes Y-U-V-All-PSNR 43.50 46.33 45.26   44.13 dB
           (1.02 bpp)
block count:  intra4:        332  (83.00%)
              intra16:        68  (17.00%)
              skipped:         1  (0.25%)
bytes used:  header:            217  (1.7%)
             mode-partition:   1554  (12.2%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    7709 |     167 |     208 |     104 |    8188  (64.4%)
 intra16-coeffs:  |     148 |      49 |     102 |      68 |     367  (2.9%)
  chroma coeffs:  |    2094 |      93 |     114 |      61 |    2362  (18.6%)
    macroblocks:  |      71%|       6%|      10%|      13%|     400
      quantizer:  |      16 |      12 |       8 |       8 |
   filter level:  |      11 |       3 |       4 |       4 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    9951 |     309 |     424 |     233 |   10917  (85.9%)

Success
Reduction: 91% (went from 134 kb to 12 kb)

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
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 85 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp.lossless.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png.webp.lossless.webp'
File:      [doc-root]/wp-content/uploads/2018/12/SuperhotCustomOculusHomeItem-1000x589-o0c9mlgwgw2pey8klvjvlnyy7mneg0wvamslvtn4si-400x250.png
Dimension: 400 x 250
Output:    70030 bytes (5.60 bpp)
Lossless-ARGB compressed size: 70030 bytes
  * Header size: 2730 bytes, image data size: 67274
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=3 transform=3 cache=10

Success
Reduction: 49% (went from 134 kb to 68 kb)

Picking lossy
cwebp succeeded :)

Converted image in 625 ms, reducing file size with 91% (went from 134 kb to 12 kb)
