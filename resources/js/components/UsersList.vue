<template>
    <div class="users-list">

    </div>
</template>

<script>
export default {
    name: "UsersList"
}
</script>

<style scoped>
    .users-list {
        width: auto;
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        overflow-y: auto;

        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0,0,0,0.03);
        border-bottom: 1px solid rgba(0,0,0,0.125);
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }
</style>
