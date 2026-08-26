<style>
    
/* Pagination Skeleton */

.skl-pagination {
display: flex;
justify-content: center;
align-items: center;
gap: 8px;
margin-top: 25px;
}

.skl-page-btn {
width: 82px;
height: 38px;
background: #c9c9c9;
border-radius: 10px;
}

.skl-page-number {
width: 46px;
height: 38px;
background: #c9c9c9;
border-radius: 10px;
}

.skl-pagination-info {
width: 300px;
height: 16px;
background: #c9c9c9;
margin: 25px auto 20px;
}
/* Mobile */

@media (max-width: 425px) {
.skl-pagination {
gap: 5px;
flex-wrap: wrap;
}
.skl-page-btn {
width: 65px;
height: 34px;
}
.skl-page-number {
width: 40px;
height: 34px;
}
.skl-pagination-info {
width: 250px;
}
.skl_wrapper {
justify-content: center;
}
.skl-card {
width: 100%;
max-width: 400px;
}
}

@media (min-width: 426px) and (max-width: 768px) {
.skl_wrapper {
justify-content: flex-start;
}
.skl-card {
width: 100%;
max-width: 235px;
}
}

</style>
<div class="col-sm-12" id="skl-pagination">
    <!-- Pagination Skeleton -->
    <div class="skl-pagination">

        <div class="skl-page-btn skeleton"></div>

        <div class="skl-page-btn skeleton"></div>

        <div class="skl-page-number skeleton"></div>

        <div class="skl-page-btn skeleton"></div>

        <div class="skl-page-btn skeleton"></div>

    </div>

    <!-- Pagination Info Skeleton -->
    <div class="skl-pagination-info skeleton"></div>
</div>

