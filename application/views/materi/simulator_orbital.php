<style>

    .app {
        width: min(960px, calc(100vw - 76px));
        min-height: 600px;
        margin: 25px auto 30px;
        background: #292929;
        border: 1px solid #555;
        border-radius: 32px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 0 0 1px rgba(255,255,255,.03);
    }

    /* ===== TOP BAR ===== */
    .topbar {
        height: 65px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 0 25px;
        gap: 25px;
    }

    .top-icon {
        width: 28px;
        height: 28px;
        color: #f2f2f2;
        opacity: .95;
        display: grid;
        place-items: center;
        font-family: Arial, sans-serif;
        font-size: 30px;
        line-height: 1;
        cursor: pointer;
        user-select: none;
    }

    .undo-icon {
        font-size: 31px;
        transform: rotate(-7deg);
    }

    .share-icon {
        font-size: 31px;
    }

    /* ===== ORBITAL AREA ===== */
    .orbital-area {
        min-height: 345px;
        padding: 15px 45px 28px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        border-bottom: 1px solid #555;
    }

    .orbital-board {
        width: 720px;
        max-width: 100%;
        position: relative;
        padding-top: 5px;
    }

    .orbital-grid {
        display: grid;
        grid-template-columns: 70px 92px 92px 92px 92px 92px;
        grid-template-rows: 53px 53px 53px 53px;
        column-gap: 12px;
        row-gap: 1px;
        justify-content: center;
        align-items: center;
    }

    .shell {
        text-align: right;
        padding-right: 10px;
        color: #ededed;
        font-style: italic;
        font-size: 18px;
        white-space: nowrap;
    }

    .orbital-slot {
        min-height: 50px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        position: relative;
    }

    .orbital-label {
        position: absolute;
        top: -7px;
        width: 100%;
        text-align: center;
        color: #e9e9e9;
        font-size: 15px;
        font-style: italic;
        line-height: 1;
    }

    .orbital-label.selected {
        color: #4d91ff;
    }

    .orbital-boxes {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
        min-height: 34px;
    }

    .electron-box {
        width: 38px;
        height: 30px;
        border-radius: 4px;
        background: #333;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        font-family: Arial, sans-serif;
        font-size: 22px;
        line-height: 1;
        transition: .18s ease;
    }

    .electron-box.filled {
        background: #4a4a4a;
    }

    .electron-box.selected {
        background: #292929;
        border: 1.5px solid #4285f4;
        color: #4285f4;
        box-shadow: 0 0 0 1px rgba(66,133,244,.05);
    }

    .electron-box.empty {
        background: #353535;
        color: transparent;
    }

    .electron-box .arrow {
        display: inline-block;
        transform: translateY(-1px);
        font-weight: normal;
    }

    .electron-box .arrow + .arrow {
        margin-left: -1px;
    }

    /* Grid placement:
       col 1 shell
       col 2 = s
       col 3-5 = p
       col 6/7 etc are created dynamically with overflow-like d group.
    */
    .row {
        display: grid;
        grid-template-columns: 70px 92px 1fr;
        column-gap: 12px;
        min-height: 53px;
        align-items: center;
    }

    .row-content {
        display: flex;
        align-items: center;
        min-height: 48px;
    }

    .s-slot {
        width: 92px;
        flex: 0 0 92px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        min-height: 48px;
    }

    .p-slot {
        width: 270px;
        flex: 0 0 270px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        min-height: 48px;
    }

    .d-slot {
        width: 365px;
        flex: 0 0 365px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        min-height: 48px;
    }

    .wide-row {
        display: flex;
        align-items: center;
    }

    .empty-space {
        width: 92px;
        flex: 0 0 92px;
    }

    .d-slot .orbital-boxes {
        gap: 8px;
    }

    .d-slot .electron-box {
        width: 38px;
    }

    /* ===== OPTIONS ===== */
    .options {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 28px;
        margin-top: 14px;
        color: #ddd;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    .option {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .checkbox {
        width: 19px;
        height: 19px;
        border: 1.5px solid #eee;
        border-radius: 3px;
        display: inline-block;
        position: relative;
    }

    .checkbox.blue {
        border-color: #eee;
    }

    .checkbox.blue::after {
        content: "";
        position: absolute;
        inset: 2px;
        border-radius: 2px;
        background: transparent;
    }

    .spin {
        font-weight: bold;
        font-size: 17px;
    }

    .hint {
        margin-top: 13px;
        text-align: center;
        color: #ddd;
        font-size: 17px;
        line-height: 1.35;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: clip;
    }

    /* ===== INFORMATION AREA ===== */
    .information {
        min-height: 185px;
        padding: 24px 45px 20px;
        text-align: center;
        border-bottom: 1px solid #555;
    }

    .configuration {
        font-size: clamp(24px, 3vw, 30px);
        font-weight: 600;
        line-height: 1.2;
        letter-spacing: .3px;
        color: #f1f1f1;
        margin-bottom: 20px;
    }

    .configuration sup {
        font-size: .65em;
        position: relative;
        top: -.35em;
    }

    .description {
        font-size: 24px;
        color: #eee;
        line-height: 1.3;
    }

    /* ===== SLIDER ===== */
    .slider-area {
        padding: 14px 12px 18px;
        position: relative;
    }

    .slider-wrap {
        height: 48px;
        border: 3px solid #f3f3f3;
        border-radius: 15px;
        display: flex;
        align-items: center;
        padding: 0 12px;
        position: relative;
    }

    .z-label {
        font-size: 18px;
        font-style: italic;
        width: 36px;
        flex: 0 0 36px;
    }

    .z-value {
        width: 55px;
        flex: 0 0 55px;
        text-align: center;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    .range-wrap {
        flex: 1;
        position: relative;
        height: 34px;
        display: flex;
        align-items: center;
    }

    input[type="range"] {
        appearance: none;
        -webkit-appearance: none;
        width: 100%;
        height: 30px;
        background: #444;
        border-radius: 18px;
        outline: none;
        cursor: pointer;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #fff;
        border: none;
        box-shadow: 0 1px 4px rgba(0,0,0,.4);
    }

    input[type="range"]::-moz-range-thumb {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #fff;
        border: none;
        box-shadow: 0 1px 4px rgba(0,0,0,.4);
    }

    .feedback {
        position: absolute;
        right: 14px;
        bottom: -27px;
        color: #aaa;
        font-family: Arial, sans-serif;
        font-size: 15px;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 850px) {
        .app {
            width: calc(100vw - 20px);
            margin: 10px auto 25px;
            border-radius: 22px;
        }

        .topbar {
            height: 54px;
            padding-right: 17px;
        }

        .orbital-area {
            padding: 12px 10px 24px;
            overflow-x: auto;
        }

        .orbital-board {
            min-width: 710px;
        }

        .information {
            padding-left: 18px;
            padding-right: 18px;
        }

        .description {
            font-size: 19px;
        }

        .options {
            font-size: 14px;
            gap: 15px;
        }

        .hint {
            font-size: 14px;
        }

        .slider-area {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
<div class="app">

    <!-- <div class="topbar">
        <div class="top-icon undo-icon" title="Kembali">↶</div>
        <div class="top-icon share-icon" title="Bagikan">⇧</div>
    </div> -->

    <section class="orbital-area">
        <div class="orbital-board">

            <div class="row">
                <div class="shell"><i>n = 1</i></div>
                <div class="s-slot" id="orb-1s"></div>
                <div></div>
            </div>

            <div class="row">
                <div class="shell"><i>n = 2</i></div>
                <div class="s-slot" id="orb-2s"></div>
                <div class="p-slot" id="orb-2p"></div>
            </div>

            <div class="row">
                <div class="shell"><i>n = 3</i></div>
                <div class="s-slot" id="orb-3s"></div>
                <div class="wide-row">
                    <div class="p-slot" id="orb-3p"></div>
                    <div class="d-slot" id="orb-3d"></div>
                </div>
            </div>

            <div class="row">
                <div class="shell"><i>n = 4</i></div>
                <div class="s-slot" id="orb-4s"></div>
                <div class="p-slot" id="orb-4p"></div>
            </div>

            <div class="options">
                <div class="option">
                    <span class="checkbox"></span>
                    <span>orbital</span>
                </div>

                <div class="option">
                    <span class="spin">↑↓</span>
                    <span>spin</span>
                </div>

                <div class="option">
                    <span class="checkbox blue"></span>
                    <span>bertambah vs Z − 1</span>
                </div>
            </div>

            <div class="hint">
                (kelompokkan berdasarkan kulit, bukan urutan pengisian (4s sebelum 3d))
            </div>

        </div>
    </section>

    <section class="information">
        <div class="configuration" id="configuration"></div>
        <div class="description" id="description"></div>
    </section>

    <section class="slider-area">
        <div class="slider-wrap">
            <div class="z-label">Z</div>
            <div class="z-value" id="zValue"></div>

            <div class="range-wrap">
                <input type="range" id="zSlider" min="1" max="36" step="1" value="17">
            </div>
        </div>
    </section>

</div>

<script>
/*
|--------------------------------------------------------------------------
| DATA STATIS
|--------------------------------------------------------------------------
| Unsur Z = 2 sampai 36.
| Konfigurasi mengikuti pola pengisian elektron.
|--------------------------------------------------------------------------
*/

const elements = {
    1:  {s:"H",  n:"Hidrogen", c:"1s",                                      e:1},
    2:  {s:"He", n:"Helium",   c:"1s²",                                      e:2},
    3:  {s:"Li", n:"Litium",   c:"1s² 2s¹",                                  e:3},
    4:  {s:"Be", n:"Berilium", c:"1s² 2s²",                                  e:4},
    5:  {s:"B",  n:"Boron",    c:"1s² 2s² 2p¹",                              e:5},
    6:  {s:"C",  n:"Karbon",   c:"1s² 2s² 2p²",                              e:6},
    7:  {s:"N",  n:"Nitrogen", c:"1s² 2s² 2p³",                              e:7},
    8:  {s:"O",  n:"Oksigen",  c:"1s² 2s² 2p⁴",                              e:8},
    9:  {s:"F",  n:"Fluorin",  c:"1s² 2s² 2p⁵",                              e:9},
    10: {s:"Ne", n:"Neon",     c:"1s² 2s² 2p⁶",                              e:10},
    11: {s:"Na", n:"Natrium",  c:"1s² 2s² 2p⁶ 3s¹",                          e:11},
    12: {s:"Mg", n:"Magnesium",c:"1s² 2s² 2p⁶ 3s²",                          e:12},
    13: {s:"Al", n:"Aluminium",c:"1s² 2s² 2p⁶ 3s² 3p¹",                      e:13},
    14: {s:"Si", n:"Silikon",  c:"1s² 2s² 2p⁶ 3s² 3p²",                      e:14},
    15: {s:"P",  n:"Fosfor",   c:"1s² 2s² 2p⁶ 3s² 3p³",                      e:15},
    16: {s:"S",  n:"Sulfur",   c:"1s² 2s² 2p⁶ 3s² 3p⁴",                      e:16},
    17: {s:"Cl", n:"Klorin",   c:"1s² 2s² 2p⁶ 3s² 3p⁵",                      e:17},
    18: {s:"Ar", n:"Argon",    c:"1s² 2s² 2p⁶ 3s² 3p⁶",                      e:18},
    19: {s:"K",  n:"Kalium",   c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s¹",                  e:19},
    20: {s:"Ca", n:"Kalsium",  c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s²",                  e:20},
    21: {s:"Sc", n:"Skandium", c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹",              e:21},
    22: {s:"Ti", n:"Titanium", c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d²",              e:22},
    23: {s:"V",  n:"Vanadium", c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d³",              e:23},
    24: {s:"Cr", n:"Kromium",  c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s¹ 3d⁵",              e:24},
    25: {s:"Mn", n:"Mangan",   c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d⁵",              e:25},
    26: {s:"Fe", n:"Besi",     c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d⁶",              e:26},
    27: {s:"Co", n:"Kobalt",   c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d⁷",              e:27},
    28: {s:"Ni", n:"Nikel",    c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d⁸",              e:28},
    29: {s:"Cu", n:"Tembaga",  c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s¹ 3d¹⁰",             e:29},
    30: {s:"Zn", n:"Seng",     c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰",             e:30},
    31: {s:"Ga", n:"Galium",   c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p¹",         e:31},
    32: {s:"Ge", n:"Germanium",c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p²",         e:32},
    33: {s:"As", n:"Arsen",    c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p³",         e:33},
    34: {s:"Se", n:"Selenium", c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p⁴",         e:34},
    35: {s:"Br", n:"Bromin",   c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p⁵",         e:35},
    36: {s:"Kr", n:"Kripton",  c:"1s² 2s² 2p⁶ 3s² 3p⁶ 4s² 3d¹⁰ 4p⁶",         e:36}
};

const order = ["1s","2s","2p","3s","3p","4s","3d","4p"];
const capacities = {
    "1s": 2, "2s": 2, "2p": 6,
    "3s": 2, "3p": 6, "4s": 2,
    "3d": 10, "4p": 6
};

const orbitalEls = {
    "1s": document.getElementById("orb-1s"),
    "2s": document.getElementById("orb-2s"),
    "2p": document.getElementById("orb-2p"),
    "3s": document.getElementById("orb-3s"),
    "3p": document.getElementById("orb-3p"),
    "4s": document.getElementById("orb-4s"),
    "3d": document.getElementById("orb-3d"),
    "4p": document.getElementById("orb-4p")
};

function superscriptConfiguration(text) {
    return text.replace(/([¹²³⁴⁵⁶⁷⁸⁹⁰]+)/g, "<sup>$1</sup>");
}

function electronDistribution(z) {
    /*
     * Pengisian visual menggunakan urutan Aufbau:
     * 1s → 2s → 2p → 3s → 3p → 4s → 3d → 4p.
     *
     * Untuk pengecualian Cr dan Cu, 4s/3d dibuat sesuai
     * konfigurasi yang ditampilkan pada materi.
     */
    const special = {
        24: {"4s":1,"3d":5},
        29: {"4s":1,"3d":10}
    };

    let remaining = z;
    const result = {};

    order.forEach(o => {
        result[o] = 0;
    });

    if (special[z]) {
        order.forEach(o => {
            if (o === "4s" || o === "3d") {
                result[o] = special[z][o];
            } else {
                const take = Math.min(capacities[o], remaining);
                result[o] = take;
                remaining -= take;
            }
        });
        return result;
    }

    for (const o of order) {
        const take = Math.min(capacities[o], remaining);
        result[o] = take;
        remaining -= take;
        if (remaining <= 0) break;
    }

    return result;
}

function boxesFor(orbital, electronCount, selected) {
    const numberOfBoxes = capacities[orbital] / 2;
    const fragment = document.createDocumentFragment();

    /*
     * Hund: untuk p/d, isi satu-satu terlebih dahulu lalu pasangan.
     * s langsung berpasangan.
     */
    let perBox = [];

    if (numberOfBoxes === 1) {
        perBox = [electronCount];
    } else {
        perBox = new Array(numberOfBoxes).fill(0);

        for (let i = 0; i < electronCount; i++) {
            if (i < numberOfBoxes) {
                perBox[i] = 1;
            } else {
                perBox[i - numberOfBoxes]++;
            }
        }
    }

    perBox.forEach((count, index) => {
        const box = document.createElement("div");
        box.className = "electron-box";

        if (count > 0) box.classList.add("filled");
        if (selected && count > 0) box.classList.add("selected");
        if (count === 0) box.classList.add("empty");

        if (count >= 1) {
            const up = document.createElement("span");
            up.className = "arrow";
            up.textContent = "↑";
            box.appendChild(up);
        }

        if (count >= 2) {
            const down = document.createElement("span");
            down.className = "arrow";
            down.textContent = "↓";
            box.appendChild(down);
        }

        fragment.appendChild(box);
    });

    return fragment;
}

function renderOrbital(orbital, count, selected) {
    const target = orbitalEls[orbital];
    target.innerHTML = "";

    const label = document.createElement("div");
    label.className = "orbital-label" + (selected ? " selected" : "");
    label.textContent = orbital;

    const boxes = document.createElement("div");
    boxes.className = "orbital-boxes";
    boxes.appendChild(boxesFor(orbital, count, selected));

    target.appendChild(label);
    target.appendChild(boxes);
}

function clearOrbitals() {
    Object.values(orbitalEls).forEach(el => el.innerHTML = "");
}

function render(z) {
    const item = elements[z];
    const distribution = electronDistribution(z);

    document.getElementById("zSlider").value = z;
    document.getElementById("zValue").textContent = z;

    document.getElementById("configuration").innerHTML =
        superscriptConfiguration(item.c);

    document.getElementById("description").textContent =
        item.n + " (" + item.s + ") memiliki " + item.e + " elektron";

    clearOrbitals();

    /*
     * Sorot orbital yang baru bertambah dibanding Z-1,
     * seperti highlight biru pada video.
     */
    let previous = z > 2 ? electronDistribution(z - 1) : {};

    order.forEach(orbital => {
        const count = distribution[orbital] || 0;
        const was = previous[orbital] || 0;
        const selected = count > was;

        renderOrbital(orbital, count, selected);
    });
}

document.getElementById("zSlider").addEventListener("input", function () {
    render(parseInt(this.value, 10));
});

render(17);
</script>