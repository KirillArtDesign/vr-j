WebP Express 0.17.2. Conversion triggered using bulk conversion, 2020-05-05 09:54:41

*WebP Convert 2.3.0*  ignited.
- PHP version: 7.0.33-0+deb9u7
- Server software: Apache/2.4.25 (Debian)

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp
- log-call-arguments: true
- converters: (array of 9 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 70
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 70
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
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
Quality: 70. 
Consider setting quality to "auto" instead. It is generally a better idea
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp.lossy.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp.lossy.webp'
File:      [doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg
Dimension: 723 x 1600
Output:    46016 bytes Y-U-V-All-PSNR 40.97 44.89 44.61   41.90 dB
           (0.32 bpp)
block count:  intra4:       1664  (36.17%)
              intra16:      2936  (63.83%)
              skipped:      2543  (55.28%)
bytes used:  header:            277  (0.6%)
             mode-partition:   8127  (17.7%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |   30085 |      16 |      13 |      37 |   30151  (65.5%)
 intra16-coeffs:  |     468 |      42 |      36 |      55 |     601  (1.3%)
  chroma coeffs:  |    6041 |      43 |      57 |     691 |    6832  (14.8%)
    macroblocks:  |      48%|       1%|       2%|      49%|    4600
      quantizer:  |      39 |      30 |      23 |      16 |
   filter level:  |      16 |       6 |       5 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |   36594 |     101 |     106 |     783 |   37584  (81.7%)

Success
Reduction: 93% (went from 659 kb to 45 kb)

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
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp.lossless.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg.webp.lossless.webp'
File:      [doc-root]/wp-content/uploads/2018/05/https_2F2Fblueprint-api-production.s3.amazonaws.com2Fuploads2Fcard2Fimage2F6143822F03652b44-c6a4-4dc0-acc5-89724ce916c4.jpg
Dimension: 723 x 1600
Output:    468916 bytes (3.24 bpp)
Lossless-ARGB compressed size: 468916 bytes
  * Header size: 6285 bytes, image data size: 462606
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=5 transform=4 cache=10

Success
Reduction: 30% (went from 659 kb to 458 kb)

Picking lossy
cwebp succeeded :)

Converted image in 2967 ms, reducing file size with 93% (went from 659 kb to 45 kb)
