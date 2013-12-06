Router performance benchmark
============================

**These benchmarks are purely informational, to help identify ways we can**
**improve overall framework performance and should not be used to persuade**
**your framework decisions in any way. Router performance alone is in no way**
**indicative of overall framework performance, and is extremely unlikely to be**
**a bottleneck in any project or application.**

This is a simple suite to compare performance of different routers. For each
router, the exact same routing structure is created. Then, the performance for
both the first route matching and the last route matching is tested.

To properly simulate per-request matching, as this is what usually happens,
every router is destroyed after each iterations and completely re-created again.

On an Intel Core i7-3930K CPU @ 3.20GHz, the following results were achieved:

```
RouterBenchmark\DashEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0003075582981] [3,251.41609]
    lastMatch : [1,000     ] [0.0003120748997] [3,204.35896]
    assemble  : [1,000     ] [0.0004219706059] [2,369.83332]


RouterBenchmark\SymfonyEvent
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0011242785454] [889.45929]
    lastMatch : [1,000     ] [0.0005993640423] [1,668.43509]
    assemble  : [1,000     ] [0.0000598101616] [16,719.56693]


RouterBenchmark\Zf2Event
    Method Name   Iterations    Average Time      Ops/second
    ----------  ------------  --------------    -------------
    firstMatch: [1,000     ] [0.0013089401722] [763.97686]
    lastMatch : [1,000     ] [0.0010079565048] [992.10630]
    assemble  : [1,000     ] [0.0000547590256] [18,261.82971]
```

You can run the tests yourself with the following command:

```vendor/bin/athletic -p src/```
